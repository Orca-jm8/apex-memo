<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\ApexRank;

class ProfileController extends Controller
{
    public function index()
    {
        $rank_id = Auth::user()->rank_id;
        $rank = ApexRank::where('id', $rank_id)->first();
        return view('profile.edit', ['rank' => $rank]);
    }

    public function update(Request $request)
    {
        if ($request->file('icon')) {
            $request->file('icon')->store('public/images');
            $path = $request->file('icon')->hashName();
        } else {
            $path = basename(Auth::user()->icon);
        }

        $user_id = Auth::id();
        $userdata = [
            'name' => $request->name,
            'rank_id' => $request->rank_id,
            'icon' => 'storage/images/' . $path,
        ];

        $user = User::findOrFail($user_id);
        $user->fill($userdata)->save();

        return redirect('/profile_edit');
    }
}
