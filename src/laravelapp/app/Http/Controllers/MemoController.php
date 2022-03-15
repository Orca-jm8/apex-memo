<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Memo;
use App\Comment;
use App\User;
use App\ApexRank;
use App\Tag;

class MemoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        $user = User::findOrFail('id', $user_id);
        $rank_id = $user->rank_id;
        $memos = Memo::where('user_id', $user_id)->get();
        $rank = ApexRank::where('id', $rank_id)->first();

        return view('memos.index', ['memos' => $memos, 'rank' => $rank]);
        */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // #(ハッシュタグ)で始まる単語を取得。結果は、$matchに多次元配列で代入される。
        preg_match_all('/#([a-zA-z0-9０-９ぁ-んァ-ヶ亜-熙]+)/u', $request->tags, $match);

        // $match[0]に#(ハッシュタグ)あり、$match[1]に#(ハッシュタグ)なしの結果が入ってくるので、$match[1]で#(ハッシュタグ)なしの結果のみを使います。
        $tags = [];
        foreach ($match[1] as $tag) {
            $record = Tag::firstOrCreate(['tag' => $tag]); // firstOrCreateメソッドで、tags_tableのnameカラムに該当のない$tagは新規登録される。
            array_push($tags, $record); // $recordを配列に追加します(=$tags)
        };

        // 投稿に紐付けされるタグのidを配列化
        $tags_id = [];
        foreach ($tags as $tag) {
            array_push($tags_id, $tag['id']);
        };

        $memo = new Memo;
        $memo->user_id = Auth::id();
        $form = $request->all();
        unset($form['_token']);
        $memo->fill($form)->save();
        $memo->tags()->attach($tags_id); // 投稿ににタグ付するために、attachメソッドをつかい、モデルを結びつけている中間テーブルにレコードを挿入します。
        return redirect(route('memo.show', $memo->user_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        $user = User::findOrFail($user_id);
        $rank_id = $user->rank_id;
        $memos = Memo::where('user_id', $user_id)->get();
        $rank = ApexRank::where('id', $rank_id)->first();

        foreach ($memos as $memo) {
            $count_comments = 0;
            $count_comments = Comment::where('memo_id', $memo->id)->count();
            $memo['count_comments'] = $count_comments;
        }
        
        $data = [
            'memos' => $memos,
            'user_id' => $user->id,
            'rank' => $rank,
            'icon' => $user->icon,
            'name' => $user->name,
        ];

        return view('memos.index', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($memo_id)
    {
        $memo = Memo::findOrFail($memo_id);
        return view('memos.edit', ['memo' => $memo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // #(ハッシュタグ)で始まる単語を取得。結果は、$matchに多次元配列で代入される。
        preg_match_all('/#([a-zA-z0-9０-９ぁ-んァ-ヶ亜-熙]+)/u', $request->tags, $match);

        // $match[0]に#(ハッシュタグ)あり、$match[1]に#(ハッシュタグ)なしの結果が入ってくるので、$match[1]で#(ハッシュタグ)なしの結果のみを使います。
        $tags = [];
        foreach ($match[1] as $tag) {
            $record = Tag::firstOrCreate(['tag' => $tag]); // firstOrCreateメソッドで、tags_tableのnameカラムに該当のない$tagは新規登録される。
            array_push($tags, $record); // $recordを配列に追加します(=$tags)
        };

        // 投稿に紐付けされるタグのidを配列化
        $tags_id = [];
        foreach ($tags as $tag) {
            array_push($tags_id, $tag['id']);
        };

        $savedata = [
            'memo' => $request->memo,
        ];

        $memo = Memo::findOrFail($id);
        $memo->user_id = Auth::id();
        $memo->fill($savedata)->save();
        $memo->tags()->attach($tags_id); // 投稿ににタグ付するために、attachメソッドをつかい、モデルを結びつけている中間テーブルにレコードを挿入します。

        return redirect(route('memo.show', $memo->user_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $memo = Memo::findOrFail($id);
        $memo->delete();

        return redirect(route('memo.show', $memo->user_id));
    }
}
