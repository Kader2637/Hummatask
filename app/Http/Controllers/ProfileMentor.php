<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileMentor extends Controller
{
    protected function profilePage()
    {
        return view('mentor.profile-mentor');
    }
}
