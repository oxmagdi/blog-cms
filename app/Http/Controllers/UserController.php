<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\View
     */
    public function show(User $user)
    {
        return view('admin.users.profile', ['user' => $user]);
    }

    public function update(User $user)
    {
        $inputs = request()->validate([
            'avatar' => ['file'],
            'username' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
//            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if(\request('avatar'))
        {
            $inputs['avatar'] = \request('avatar')->store('uploads/users');
        }

        $user->update($inputs);

        session()->flash('profile-update', 'Profile updated seuccesfuly');

        return back();
    }

}
