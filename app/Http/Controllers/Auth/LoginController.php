<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function store(CreateLoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            return redirect()->route('home');
        }

        return response()->json(['error' => 'Credentials not found']);
    }
}
