<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use App\User;
use App\Memo;
use App\Comment;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $freeWord = $request->input('free_word');

        $memos = [];

        if ($freeWord) {
            $memos = Memo::whereRaw("match(`memo`) against (? IN BOOLEAN MODE)", $freeWord)
            ->orWhereHas('tags', function (Builder $query) use ($freeWord) {
                //全文検索をかけると結果が出ないためLIKE検索になっている
                //$query->whereRaw("match(`tag`) against (? IN BOOLEAN MODE)", $freeWord);
                $query->where('tag', 'like', '%' . $freeWord . '%');
            })
            ->get();
        }

        foreach ($memos as $memo) {
            $user_id = $memo->user_id;
            $user = User::where('id', $user_id)->first();
            $user_name = $user->name;
            $memo['name'] = $user_name;
            $count_comments = 0;
            $count_comments = Comment::where('memo_id', $memo->id)->count();
            $memo['count_comments'] = $count_comments;
        }

        $param = collect($request->input());

        return view('search', ['memos' => $memos, 'parameters' => $param]);
    }
}
