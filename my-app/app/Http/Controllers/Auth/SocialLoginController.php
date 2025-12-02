<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;


class SocialLoginController extends Controller {
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback()
    {
        try {
            $githubUser = Socialite::driver('github')->user();

            // $user=>token
            $user = User::updateOrCreate(
                ['github_id' => $githubUser->id],
                [
                    'github_id' => $githubUser->id,
                    'email' => $githubUser->getEmail(),
                    'name' => $githubUser->getNickname(),
                    'password' => Hash::make($githubUser->id),
                ],
            );
            Auth::login($user, true);
            return redirect()->route('posts.index');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'GitHubログインに失敗しました');
        }
    }
}
