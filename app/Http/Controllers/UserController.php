<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->orWhere('role', 'scout')->get();
        return view('admin.users.index', ['users' => $users]);
    }

    public function add_index()
    {
        return view('admin.users.add');
    }

    public function add_post(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:155'],
            'email' => ['required', 'string', 'email', 'max:155', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'max:55']
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'password' => Hash::make($data['password']),
        ]);

        if($user->id)
        {
            $request->session()->flash('status', 'User '.$data['name'].' added successfully');
            return redirect()->route('users');
        }

        $request->session()->flash('status_error', 'User could not be added. Please try again');
        return redirect()->route('users_add');
    }


    public function update_index($id, Request $request)
    {
        $user = User::find($id);

        if($user!=null) {
             return view('admin.users.edit', ['user' => $user]);
        }

        $request->session()->flash('status_error', 'User not found');
        return redirect()->route('users');
    }

    public function update_post($id, Request $request)
    {
        $user = User::find($id);

        if($user!=null) {
            $data = $request->validate([
                'name' => ['required', 'string', 'max:155'],
                'email' => ['required', 'string', 'email', 'max:155', 'unique:users,email,'.$user->id],
                'password' => ['nullable', 'string', 'min:8'],
                'role' => ['required', 'string', 'max:55']
            ]);

            $user->name = $data['name'];
            $user->email = $data['email'];
            if(!empty($data['password']))
            {
                $user->password = Hash::make($data['password']);
            }
            $user->role = $data['role'];

            if($user->save()) {
                $request->session()->flash('status', 'User information changed successfully');
                return redirect()->route('users');
            }

            $request->session()->flash('status_error', 'Please make any changes to update');
            return redirect()->route('users_update');
        }

        $request->session()->flash('status_error', 'User not found');
        return redirect()->route('users');
    }

    public function delete($id, Request $request)
    {
        $user = User::find($id);

        if($user!=null) {
            if($user->delete())
            {
                $request->session()->flash('status', 'User '.$user->name.' removed successfully');
                return redirect()->route('users');
            }
            $request->session()->flash('status_error', 'User cannot be removed. Please try again');
            return redirect()->route('users');
        }

        $request->session()->flash('status_error', 'User not found');
        return redirect()->route('users');
    }
}
