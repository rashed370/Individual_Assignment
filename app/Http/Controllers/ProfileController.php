<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:155'],
            'email' => ['required', 'string', 'email', 'max:155', 'unique:users,email,'.auth()->user()->id],
            'password' => ['nullable', 'string', 'min:8']
        ]);

        auth()->user()->name = $data['name'];
        auth()->user()->email = $data['email'];
        if(!empty($data['password'])) {
            auth()->user()->password = Hash::make($data['password']);
        }


        if(auth()->user()->save()) {
            $request->session()->flash('status', 'Profile information changed successfully');
            return redirect()->route('home');
        }

        $request->session()->flash('status_error', 'Please make any changes to update');
        return redirect()->route('profile');
    }
}
