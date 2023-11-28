<?php

namespace App\Http\Controllers;

use App\Models\peran;
use App\Models\Presentasi;
use App\Models\Project;
use App\Models\Galery;
use App\Models\Tim;
use App\Models\Tugas;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\Events\PasswordReset;
use Laravel\Socialite\Facades\Socialite;
use Intervention\Image\ImageManagerStatic as Image;

class authController extends Controller
{
    protected function welcomePage(Request $request)
    {
        $title = 'Hummatask';
        $user = User::all()->where('peran_id', 1)->count();
        $tim = Tim::all()->count();
        $project = Project::all()->count();
        $task = Presentasi::all()->where('status_presentasi', 'selesai')->count();
        $galery = Galery::where('status','album')->get();
        $logo = Galery::where('status','logo')->get();

        return response()->view('welcome', compact('title', 'user', 'tim', 'project', 'task', 'galery', 'logo'));
    }

    protected function loginPage(Request $request)
    {
        $title = 'Login';
        return response()->view('auth.login', compact('title'));
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

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            throw ValidationException::withMessages(['email' => 'Email tidak ditemukan']);
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with(['status' => __('Reset link telah dikirim. Silakan cek email Anda untuk petunjuk lebih lanjut.')]);
        } else {
            return back()->withErrors(['email' => __('Tunggu beberapa saat lagi untuk kirim email')]);
        }
    }

    public function passwordReset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function resetPage(string $token, Request $request)
    {
        $title = 'Ganti';
        return view('auth.reset', ['token' => $token], compact('title'));
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

        $rememberMe = $request->has('remember'); // Check if the remember checkbox is checked

        try {
            if (Auth::attempt($credentials, $rememberMe)) {
                $user = auth()->user();
                User::where('id', $user->id)->update(['is_login' => true]);

                switch ($user->peran_id) {
                    case 1:
                        return redirect()->intended(route('dashboard.siswa'));
                    case 2:
                        return redirect()->intended(route('dashboard.mentor'));
                }
            }
        } catch (\Throwable $th) {
            return abort(404);
        }

        return redirect()->route('login')->withErrors(['password' => 'Email atau password tidak sesuai.'])->withInput();
    }

    protected function logout()
    {
        try {
            User::where('id', auth()->user()->id)->update(['is_login' => false]);
            Auth::logout();
            return redirect()->route('login');
        } catch (\Throwable $th) {
            return back();
        }
    }
}
