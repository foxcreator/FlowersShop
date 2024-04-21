<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store(CreateRegisterRequest $request)
    {
        $user = User::create([
            'phone' => $request->validated('phone'),
            'password' => Hash::make($request->validated('password')),
        ]);

        if ($user) {
            Auth::login($user);
            return redirect()->route('home');
        }
        return redirect()->back();
    }
}
