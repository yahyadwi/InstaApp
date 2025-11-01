<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile($username)
    {
        $user = User::where('username', $username)
            ->with(['posts', 'followers', 'following'])
            ->firstOrFail();

        return view('users.profile', compact('user'));
    }

    public function follow(User $user)
    {
        $currentUser = Auth::user();

        if ($currentUser->isFollowing($user->id)) {
            $currentUser->following()->detach($user->id);
            $following = false;
        } else {
            $currentUser->following()->attach($user->id);
            $following = true;
        }

        return response()->json([
            'following' => $following,
            'followers_count' => $user->followers()->count(),
        ]);
    }
}
