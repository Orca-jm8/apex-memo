<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Memo;

class MainController extends Controller
{
    public function index()
    {
        $memos = Memo::all();

        return view('index', ['memos' => $memos]);
    }
}
