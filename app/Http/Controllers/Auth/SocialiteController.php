<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback(Request $request)
    {
        if (!\auth()->user()) {
            $googleUser = Socialite::driver('google')->user();
            $data = [
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'avatar' => $googleUser->getAvatar(),
                'google_id' => $googleUser->getId(),
                'email_verified_at' => now(),
            ];

            $user = User::query()->where('email', $googleUser->getEmail())->first();
                if ($user) {
                    if (!$user->google_id) {
                        $user->update([
                            'avatar' => $user->avatar ? $user->avatar : $googleUser->getAvatar(),
                            'google_id' => $googleUser->getId(),
                            'email_verified_at' => $user->email_verified_at ? $user->email_verified_at : now(),
                            'full_name' => $googleUser->getName(),
                        ]);
                    }
                } else {
                    $user = User::create($data);
//                    $user->assignRole('user');
                }

            Auth::login($user);

        }
        return redirect()->intended();

    }
}
