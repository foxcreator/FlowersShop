<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Rules\IssetEmailRule;
use App\Rules\ValidCredentialsRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{

    public function create()
    {
        return view('auth.forgot-password');
    }
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', new IssetEmailRule()],
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with(['success' => "Посилання для відновлення паролю надіслано на пошту $request->email"]);
        }

        return back()->with(['error' => $status])->withInput($request->only('email'));
    }
}
