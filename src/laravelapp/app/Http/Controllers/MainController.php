<?php

namespace App\Http\Controllers;

use App\Memo;

class MainController extends Controller
{
    public function index()
    {
        $memos = Memo::with(['user', 'comments'])
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        foreach ($memos as $memo) {
            $memo['name'] = $memo->user->name;
            $memo['count_comments'] = $memo->comments->count();
        }

        return view('index', ['memos' => $memos]);
    }
}
