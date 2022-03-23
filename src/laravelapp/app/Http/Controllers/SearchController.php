<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;

use App\Http\Requests\SearchRequest;
use App\Memo;

class SearchController extends Controller
{
    public function search(SearchRequest $request)
    {
        $freeWord = $request->input('free_word');

        if ($freeWord) {
            $memos = Memo::whereRaw("match(`memo`) against (? IN BOOLEAN MODE)", $freeWord)
            ->orWhereHas('tags', function (Builder $query) use ($freeWord) {
                //全文検索をかけると結果が出ないためLIKE検索になっている
                //$query->whereRaw("match(`tag`) against (? IN BOOLEAN MODE)", $freeWord);
                $query->where('tag', 'like', '%' . $freeWord . '%');
            })
            ->with('user', 'comments')
            ->get();
        }

        foreach ($memos as $memo) {
            $memo['name'] = $memo->user->name;
            $memo['count_comments'] = $memo->comments->count();
        }

        $param = collect($request->input());

        return view('search', ['memos' => $memos, 'parameters' => $param]);
    }
}
