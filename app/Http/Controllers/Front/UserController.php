<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

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

        if ($user->update($data)) {
            return redirect()->back()->with(['success' => 'Данные успешно обновлены']);
        }
        return redirect()->back()-with(['error' => ' Something went wrong']);
    }
}
