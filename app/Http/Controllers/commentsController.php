<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class commentsController extends Controller
{

     protected function comments(Request $request){
        $comments = new Comments;
        $comments->user_id = Auth::user()->id;
        $comments->tugas_id = $request->input('tugas_id');
        $comments->text = $request->input('text');
        $comments->save();
        return response()->json($comments);
     }
}
