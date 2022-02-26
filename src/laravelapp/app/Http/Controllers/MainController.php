<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Memo;
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
        }

        return view('index', ['memos' => $memos]);
    }
}
