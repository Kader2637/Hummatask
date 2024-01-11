<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class LoginController extends Controller
{
    /**
     * login
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            $data['token'] =  auth()->user()->createToken('auth_token')->plainTextToken;
            $data['user'] = UserResource::make(auth()->user());
            return ResponseHelper::success($data, "Berhasil login");
        }
        else {
            return ResponseHelper::error(null, "Username / password salah");
        }
    }

    /**
     * logout
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        auth()->user()->currentAccessToken()->delete();
        return ResponseHelper::success(auth()->user()->token, 'success logout');
    }

    /**
     * forgot
     *
     * @param  mixed $request
     * @return void
     */
    public function forgot(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return ResponseHelper::success(null, 'Reset link telah dikirim. Silakan cek email Anda untuk petunjuk lebih lanjut.');
        } else {
            return ResponseHelper::success(null, 'Tunggu beberapa saat lagi untuk kirim email');
        }
    }
}
