<?php

namespace App\Http\Controllers;

use App\Memo;
use App\Comment;
use App\User;

class MainController extends Controller
{
    public function index()
    {
        $memos = Memo::all();

        foreach ($memos as $memo) {
            $user_id = $memo->user_id;
            $user = User::where('id', $user_id)->first();
            $user_name = $user->name;
            $memo['name'] = $user_name;
            $count_comments = 0;
            $count_comments = Comment::where('memo_id', $memo->id)->count();
            $memo['count_comments'] = $count_comments;
        }

        return view('index', ['memos' => $memos]);
    }
}
