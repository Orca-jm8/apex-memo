<?php

namespace App\Http\Controllers;

use App\Memo;
use App\Tag;

class HashtagController extends Controller
{
    public function show(string $hashtag)
    {
        $tag = Tag::where('tag', '=', $hashtag)
        ->with('memos.user', 'memos.comments')
        ->get();
        $memos = $tag->first()->memos;

        foreach ($memos as $memo) {
            $memo['name'] = $memo->user->name;
            $memo['count_comments'] = $memo->comments->count();
        }

        return view('hashtag.index', ['memos' => $memos]);
    }
}
