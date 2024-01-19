<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required']
            ]);

            if(Auth::guard('web')->attempt($data)){
                $request->session()->regenerate();
                return redirect('profile');
            }

            $request->session()->flash('invalid', 'Wrong login or password!');
            return redirect(route('login'));
        }

        return view('auth.login', ['facebookLink' => $this->facebook()]);
    }

    public function logout(Request $request)
    {
        if($request->isMethod('get')){
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect(route('login'));
        }
        return back();
    }

    protected function facebook()
    {
        $params = [
            'client_id' => env('FACEBOOK_CLIENT_ID'),
            'redirect_uri' => env('FACEBOOK_REDIRECT_URI'),
            'state' => '{"{st=state123abc,ds=123456789}"}',
            'scope' => 'email'
        ];
        return 'https://www.facebook.com/v18.0/dialog/oauth?' . http_build_query($params);
    }
}
