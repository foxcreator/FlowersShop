<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('front.pages.user-profile.index');
    }

    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::find($id);
        $data = $request->validated();
        unset($data['current_password']);
        $data['password'] = Hash::make($data['password']);

        if ($user->update($data)) {
            return redirect()->back()->with(['success' => __('statuses.data-update')]);
        }
        return redirect()->back()-with(['error' => ' Something went wrong']);
    }
}
