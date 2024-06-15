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
        $data = $request->validated();
        $isEmail = filter_var($data['credential'], FILTER_VALIDATE_EMAIL);
        if ($isEmail) {
            $credentials = [
                'email' => $data['credential'],
                'password' => $data['password']
            ];
        } else {
            $credentials = [
                'phone' => $data['credential'],
                'password' => $data['password']
            ];
        }

        if (Auth::attempt($credentials)) {
            if ($request->ajax()) {
                return response(['login' => true]);
            }
            if (\auth()->user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }elseif (\auth()->user()->isManager()) {
                return redirect()->route('sales.index');
            } else {
                return redirect()->route('home');
            }
        }

        return response()->json(['error' => 'Credentials not found']);
    }
}
