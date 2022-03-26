<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use App\Http\Requests\MemoRequest;
use App\Memo;
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
        //
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
    public function store(MemoRequest $request)
    {
        preg_match_all('/#([a-zA-z0-9０-９ぁ-んァ-ヶ亜-熙]+)/u', $request->tags, $match);

        $tags = [];
        foreach ($match[1] as $tag) {
            $record = Tag::firstOrCreate(['tag' => $tag]);
            array_push($tags, $record);
        };

        $tags_id = [];
        foreach ($tags as $tag) {
            array_push($tags_id, $tag['id']);
        };

        $memo = new Memo;
        $memo->user_id = Auth::id();
        $form = $request->all();
        unset($form['_token']);

        if (app()->isLocal()) {
            if ($request->file('content')) {
                $request->file('content')->store('public/images');
                $path = $request->file('content')->hashName();
            } else {
                $path = basename(Auth::user()->icon);
            }
            $mime = $request->file('content')->getMimeType();
            $is_image = explode('/', $mime)[0] == 'image';
            if ($is_image) {
                $form['content'] = asset('storage/images/' . $path);
            } else {
                $form['video'] = asset('storage/images/' . $path);
                unset($form['content']);
            }
        } else {
            if ($request->file('content')) {
                $image = $request->file('content');
                $icon = Storage::disk('s3')->putFile('/contents', $image, 'public');
                $path = Storage::disk('s3')->url($icon);
            } else {
                $path = Auth::user()->icon;
            }
            $mime = $request->file('content')->getMimeType();
            $is_image = explode('/', $mime)[0] == 'image';
            if ($is_image) {
                $form['content'] = $path;
            } else {
                $form['video'] = $path;
                unset($form['content']);
            }
        }

        $memo->fill($form)->save();
        $memo->tags()->attach($tags_id);
        return redirect(route('memo.show', $memo->user_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $user_id)
    {
        $user = User::findOrFail($user_id);
        $rank_id = $user->rank_id;
        $memos = Memo::where('user_id', $user_id)->with('comments')->get();
        $rank = ApexRank::where('id', $rank_id)->first();

        foreach ($memos as $memo) {
            $memo['count_comments'] = $memo->comments->count();
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
    public function edit(int $memo_id)
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
    public function update(MemoRequest $request, int $id)
    {
        preg_match_all('/#([a-zA-z0-9０-９ぁ-んァ-ヶ亜-熙]+)/u', $request->tags, $match);

        $tags = [];
        foreach ($match[1] as $tag) {
            $record = Tag::firstOrCreate(['tag' => $tag]);
            array_push($tags, $record);
        };

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
        $memo->tags()->attach($tags_id);

        return redirect(route('memo.show', $memo->user_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $memo = Memo::findOrFail($id);
        $memo->delete();

        return redirect(route('memo.show', $memo->user_id));
    }
}
