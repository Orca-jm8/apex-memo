<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Memo;
use App\User;
use App\ApexRank;

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
        $memo = new Memo;
        $memo->user_id = Auth::id();
        $form = $request->all();
        unset($form['_token']);
        $memo->fill($form)->save();
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
        $savedata = [
            'memo' => $request->memo,
        ];

        $memo = Memo::findOrFail($id);
        $memo->user_id = Auth::id();
        $memo->fill($savedata)->save();

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
