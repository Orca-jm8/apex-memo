<?php

namespace App\Http\Controllers;

use App\User;
use App\ApexRank;
use App\Memo;
use Illuminate\Http\Request;

use App\Http\Requests\ProfileRequest;

class UserController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $rank = ApexRank::where('id', $user->rank_id)->first();

        $memos = Memo::where('user_id', $user->id)->with('comments')->paginate(10);

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

        return view('users.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $rank_id = $user->rank_id;
        $rank = ApexRank::where('id', $rank_id)->first();

        return view('profile.edit', ['rank' => $rank]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, User $user)
    {
        if (app()->isLocal()) {
            if ($request->file('icon')) {
                $request->file('icon')->store('public/images');
                $path = $request->file('icon')->hashName();
            } else {
                $path = basename($user->icon);
            }
            $userdata = [
                'name' => $request->name,
                'rank_id' => $request->rank_id,
                'icon' => asset('storage/images/' . $path),
            ];
        } else {
            if ($request->file('icon')) {
                $image = $request->file('icon');
                $icon = Storage::disk('s3')->putFile('/icon', $image, 'public');
                $path = Storage::disk('s3')->url($icon);
            } else {
                $path = $user->icon;
            }
            $userdata = [
                'name' => $request->name,
                'rank_id' => $request->rank_id,
                'icon' => $path,
            ];
        }

        $user_id = $user->id;
        $user = User::findOrFail($user_id);
        $user->fill($userdata)->save();

        return redirect(route('memos.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
