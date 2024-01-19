<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->validate([
                'name' => ['required', 'min:2', 'string'],
                'email' => ['required', 'email'],
                'password' => ['required', Password::min(6)]
            ]);

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);
            if($user){
                Auth::guard('web')->login($user);
                $request->session()->regenerate();
                return redirect(route('profile'));
            }
        }
        return view('auth.register');
    }
}
