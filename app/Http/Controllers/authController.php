<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class authController extends Controller
{
    protected function welcomePage(Request $request)
    {
        $title = 'Hummatask';
        return response()->view('welcome', compact('title'));
    }

    protected function loginPage(Request $request)
    {
        $title = 'Login';
        return response()->view('auth.login', compact('title'));
    }

    protected function registerPage(Request $request)
    {
        $title = 'Register';
        return response()->view('auth.register', compact('title'));
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

    protected function dashboardPage(Request $request)
    {
        $title = 'Dashboard';
        return response()->view('welcome', compact('title'));
    }
}
