<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\ProfileRequest;
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

    public function update(ProfileRequest $request)
    {
        if (app()->isLocal()) {
            if ($request->file('icon')) {
                $request->file('icon')->store('public/images');
                $path = $request->file('icon')->hashName();
            } else {
                $path = basename(Auth::user()->icon);
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
                $path = Auth::user()->icon;
            }
            $userdata = [
                'name' => $request->name,
                'rank_id' => $request->rank_id,
                'icon' => $path,
            ];
        }

        $user_id = Auth::id();
        $user = User::findOrFail($user_id);
        $user->fill($userdata)->save();

        return redirect('/profile_edit');
    }
}
