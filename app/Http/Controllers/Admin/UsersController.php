<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\SearchHelper;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) {
            $users = SearchHelper::search(
                User::class,
                ['id', 'full_name', 'email', 'phone',],
                $request->search,
                ['full_name' => 'asc'],
            );
        } else {
            $users = User::query()->orderBy('full_name')->paginate(20);
        }
        return view('admin.users.index', compact('users'));
    }

    public function show(string $id)
    {
        $user = User::find($id);
        return view('admin.users.show', compact('user'));
    }

    public function changeRole(Request $request)
    {
        $user = User::find($request->id);
        $user->is_admin = $request->role;
        $user->save();
        return redirect()->back();
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = User::find($request->id);
        $user->password = Hash::make($request->password);
        if ($user->save()) {
            return redirect()->back()->with(['status' => 'Пароль успешно обновлен']);
        }
        return redirect()->back()->with(['error' => 'Что то пошло не так :(']);
    }
}
