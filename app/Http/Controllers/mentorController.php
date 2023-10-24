<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class mentorController extends Controller
{
    protected function dashboard()
    {
        return response()->view('mentor.dashboard');
    }
    protected function pengguna()
    {
        return response()->view('mentor.pengguna');
    }
    protected function history()
    {
        return response()->view('mentor.history');
    }
}
