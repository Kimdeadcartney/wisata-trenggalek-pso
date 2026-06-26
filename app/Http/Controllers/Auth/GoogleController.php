<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Exception;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id', $googleUser->id)->first();

            if (!$user) {

                $user = User::updateOrCreate(
                    [
                        'email' => $googleUser->email,
                    ],
                    [
                        'name' => $googleUser->name,
                        'google_id' => $googleUser->id,
                        'password' => Hash::make(Str::random(32)),
                    ]
                );
            }

            Auth::login($user, true);

            return redirect('/');

        } catch (Exception $e) {

            dd([
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

        }
    }
}