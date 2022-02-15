<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return view('comments.index');
    }

    public function update()
    {
        return view('comments.edit');
    }
}
