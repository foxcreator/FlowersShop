<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


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

    public function saveCity(Request $request)
    {
        if (auth()->user()) {
            auth()->user()->update(['city' => $request->city, 'city_ref' => $request->ref]);
        } else {
            Session::put(['city' => $request->city, 'city_ref' => $request->ref]);
        }

        return response()->json(['success' => __('statuses.save-success')]);
    }

    public function checkboxCredentialsUpdate(Request $request, User $user)
    {
        try {
            $data = $request->all();
            unset($data['_token']);
            $user->update($data);
            $user->save();

            return redirect()->back()->with(['success' => 'Данные кассира успешно сохранены']);
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => $exception->getMessage()]);
        }

    }
}
