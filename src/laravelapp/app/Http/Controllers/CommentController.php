<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\CommentRequest;
use App\Comment;

class CommentController extends Controller
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
    public function store(CommentRequest $request, int $memo_id)
    {
        $comment = new Comment;
        $comment->memo_id = $memo_id;
        $user_id = Auth::id();
        if (isset($user_id)) {
            $comment->user_id = $user_id;
        }
        $form = $request->all();
        unset($form['_token']);
        $comment->fill($form)->save();
        return redirect(route('memo.comment.index', $comment->memo_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $memo_id, int $comment_id)
    {
        $comment = Comment::findOrFail($comment_id);

        return view('comments.edit', ['memo_id' => $memo_id, 'comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CommentRequest $request, int $memo_id, int $comment_id)
    {
        $savedata = [
            'comment' => $request->comment,
        ];

        $comment = Comment::findOrFail($comment_id);
        $comment->fill($savedata)->save();

        return redirect(route('memos.show', $memo_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $memo_id, int $comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        $comment->delete();

        return redirect(route('memos.show', $memo_id));
    }
}
