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
//        dd($request->validated());
        $user = User::create([
            'name' => $request->validated('name'),
            'last_name' => $request->validated('last_name'),
            'phone' => $request->validated('phone'),
            'email' => $request->validated('email'),
            'password' => Hash::make($request->validated('password')),
        ]);

        if ($user) {
//            event(new Registered($user));
            Auth::login($user);
            return redirect()->route('home');
        }
        return redirect()->back();
    }
}
