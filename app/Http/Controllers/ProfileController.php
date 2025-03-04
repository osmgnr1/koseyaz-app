<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Comment;
use App\Models\CornerPost;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // dd($user->cornerPosts()->pluck('id'));

        Auth::logout();
        $user->likes()->delete();
        $user->views()->delete();
        // $user->replies()->delete(); It should be deleted when comment will be deleted
        Comment::whereIn('commentable_id', $user->cornerPosts()->pluck('id'))->delete();
        $user->comments()->delete();
        $user->cornerPosts()->delete();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function show(User $user)
    {

        // dd($request->user);
        // $cornerposts = CornerPost::where('user_id', $request->user)->get();
        $cornerposts = CornerPost::where('user_id', $user->id)->get();
        // $user = User::find($request->user);

        // dd($cornerposts);

        // compact(['user'=>$user],['cornerposts'=>$cornerposts]);

        return view('profile.user')->with('user',$user)->with('cornerposts',$cornerposts);

    }

}
