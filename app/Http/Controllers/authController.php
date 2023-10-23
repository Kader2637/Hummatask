<?php

namespace App\Http\Controllers;

use App\Models\peran;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use Intervention\Image\ImageManagerStatic as Image;

class authController extends Controller
{
    protected function welcomePage(Request $request)
    {
        $title = 'Hummatask';
        return response()->view('welcome', compact('title'));
    }

    protected function loginPage(Request $request)
    {
        try {
            foreach (Cookie::get() as $name => $value) {
                Cookie::queue(Cookie::forget($name));
            }
            $title = 'Login';
            return response()->view('auth.login', compact('title'));
        } catch (\Throwable $th) {
            return response()->back();
        }
    }

    protected function registerPage(Request $request)
    {
        try {
            foreach (Cookie::get() as $name => $value) {
                Cookie::queue(Cookie::forget($name));
            }
            $title = 'Register';
            $perans = peran::all();
            return response()->view('auth.register', compact('title', 'perans'));
        } catch (\Throwable $th) {
            return response()->back();
        }
    }

    protected function resetPasswordPage(Request $request)
    {
        $title = 'Reset Password';
        return response()->view('auth.reset', compact('title'));
    }

    protected function lupaPasswordPage(Request $request)
    {
        $title = 'Lupa Password';
        return response()->view('auth.forgot', compact('title'));
    }

    protected function verifyPage(Request $request)
    {
        $title = 'Verify';
        return response()->view('auth.verify', compact('title'));
    }

    protected function stepsPage(Request $request)
    {
        $title = 'Steps';
        return response()->view('auth.steps', compact('title'));
    }

    protected function profilePage(Request $request)
    {
        $title = 'Profile';
        $perans = peran::all();
        return response()->view('auth.profile', compact('title', 'perans'));
    }

    protected function dashboardPage(Request $request)
    {
        $title = 'Dashboard';
        return response()->view('welcome', compact('title'));
    }

    protected function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    protected function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    protected function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $existing = User::where('email', $user->email)->first();
            if ($existing) {
                Auth::login($existing);
                return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
            } else {
                $session = [
                    'code' => Str::uuid(),
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                ];
                Session::put('user', $session);
                Cookie::queue('code', $session['code'], 60);
                Cookie::queue('name', $session['name'], 60);
                Cookie::queue('email', $session['email'], 60);
                Cookie::queue('google_id', $session['google_id'], 60);
                return redirect("/profile/" . $session['code'])->with('user', Session::get('user'));
            }
        } catch (\Throwable $th) {
            return redirect()->route('register')->with('error', 'Gagal authentication.');
        }
    }

    protected function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->stateless()->user();
            $existing = User::where('email', $user->email)->first();
            if ($existing) {
                Auth::login($existing);
                return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
            } else {
                $session = [
                    'code' => Str::uuid(),
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id' => $user->id,
                ];
                Session::put('user', $session);
                Cookie::queue('code', $session['code'], 60);
                Cookie::queue('name', $session['name'], 60);
                Cookie::queue('email', $session['email'], 60);
                Cookie::queue('facebook_id', $session['facebook_id'], 60);
                return redirect("/profile/" . $session['code'])->with('user', Session::get('user'));
            }
        } catch (\Throwable $th) {
            return redirect()->route('register')->with('error', 'Gagal authentication.');
        }
    }

    protected function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        try {
            if (Auth::attempt($credentials)) {
                User::where('id', auth()->user()->id)->update(['is_login' => true]);
                $user = auth()->user();
                return $user->peran_id == 1 ? redirect()->intended(route('dashboard.mentor')) : redirect()->intended(route('dashboard.siswa'));
            }
        } catch (\Throwable $th) {
            return abort(404);
        }
        return redirect('/login');
        // return redirect()->route('login')->withErrors(['password' => 'Email atau password tidak sesuai.'])->withInput();
    }

    protected function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'username' => 'required|min:6',
                'peran' => 'required',
            ],
            [
                'username.required' => 'Silakan masukkan username.',
                'username.min' => 'Username harus terdiri dari minimal 6 karakter.',
                'peran.required' => 'Silakan pilih peran Anda.',
                'peran.in' => 'Pilihan peran tidak valid.',
            ]
        );

        if ($validator->fails()) {
            return redirect('profile')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            if (!$request->file('avatar')) {
                $inisial = strtoupper(implode('', array_map(fn ($name) => substr($name, 0, 1), array_slice(explode(' ', $request->username), 0, 3))));
                $image = Image::canvas(200, 200, '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT));
                $image->text($inisial, 100, 100, function ($font) {
                    $font->file(public_path('assets/font/Poppins-Regular.ttf'));
                    $font->size(48);
                    $font->color('#ffffff');
                    $font->align('center');
                    $font->valign('middle');
                });
                $nameImage = 'avatars/' . Str::random(20) . '.jpg';
                Storage::disk('public')->put($nameImage, $image->stream());
            } else {
                $nameImage = $request->file('avatar')->store('avatars', 'public');
            }

            User::create([
                'code' => Str::uuid(),
                'avatar' => $nameImage,
                'name' => $request->username,
                'email' => Cookie::get('email'),
                'password' => Hash::make(Str::random(20)),
                'google_id' => Cookie::get('google_id') ?? null,
                'facebook_id' => Cookie::get('facebook_id') ?? null,
            ]);
        } catch (\Throwable $th) {
            return redirect()->route('register')->with('error', 'Registrasi gagal. Silakan register lagi.');
        }

        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }
}
