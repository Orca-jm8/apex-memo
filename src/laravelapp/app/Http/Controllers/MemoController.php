<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\MemoRequest;
use App\Memo;
use App\Comment;
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
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $rank = ApexRank::where('id', $user->rank_id)->first();

        $memos = Memo::where('user_id', $user->id)
            ->with('comments')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $rank = ApexRank::where('id', $user->rank_id)->first();

        $data = [
            'user_id' => $user->id,
            'rank' => $rank,
            'icon' => $user->icon,
            'name' => $user->name,
        ];

        return view('memos.create', $data);
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

                $mime = $request->file('content')->getMimeType();
                $is_image = explode('/', $mime)[0] == 'image';
                if ($is_image) {
                    $form['content'] = asset('storage/images/' . $path);
                } else {
                    $form['video'] = asset('storage/images/' . $path);
                    unset($form['content']);
                }
            }
        } else {
            if ($request->file('content')) {
                $image = $request->file('content');
                $icon = Storage::disk('s3')->putFile('/contents', $image, 'public');
                $path = Storage::disk('s3')->url($icon);

                $mime = $request->file('content')->getMimeType();
                $is_image = explode('/', $mime)[0] == 'image';
                if ($is_image) {
                    $form['content'] = $path;
                } else {
                    $form['video'] = $path;
                    unset($form['content']);
                }
            }
        }

        $memo->fill($form)->save();
        $memo->tags()->attach($tags_id);
        return redirect(route('memos.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $memo_id
     * @return \Illuminate\Http\Response
     */
    public function show(int $memo_id)
    {
        $memo = Memo::where('id', $memo_id)->with('user')->first();
        $comments = Comment::where('memo_id', $memo_id)->with('user')->get();

        $memo['name'] = $memo->user->name;
        
        foreach ($comments as $comment) {
            if ($comment->user_id) {
                $comment['name'] = $comment->user->name;
            } else {
                $comment['name'] = 'ゲストユーザー';
            }
        }

        $items = ['memo' => $memo, 'comments' => $comments];

        return view('comments.index', $items);
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
    public function update(MemoRequest $request, int $memo_id)
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

        $memo = Memo::findOrFail($memo_id);
        $memo->user_id = Auth::id();
        $memo->fill($savedata)->save();
        $memo->tags()->attach($tags_id);

        return redirect(route('memos.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $memo_id)
    {
        $memo = Memo::findOrFail($memo_id);
        $memo->delete();

        return redirect(route('memos.index'));
    }
}
