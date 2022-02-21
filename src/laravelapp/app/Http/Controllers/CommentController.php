<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($memo_id)
    {
        $comments = Comment::where('memo_id', $memo_id)->get();

        $items = ['memo_id' => $memo_id, 'comments' => $comments];

        return view('comments.index', $items);
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
    public function store(Request $request, $memo_id)
    {
        $comment = new Comment;
        $comment->memo_id = $memo_id;
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
    public function edit($comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        return view('comments.edit', ['comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $comment_id)
    {
        $savedata = [
            'comment' => $request->comment,
        ];

        $comment = Comment::findOrFail($comment_id);
        $comment->fill($savedata)->save();

        return redirect(route('memo.comment.index', $comment->memo_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect('/comment');
    }
}
