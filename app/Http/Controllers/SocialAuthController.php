<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class SocialAuthController extends Controller
{
    public function facebook(Request $request)
    {
        if($request->get('code')){
            $params = [
                'client_id' => env('FACEBOOK_CLIENT_ID'),
                'client_secret' => env('FACEBOOK_SECRET'),
                'redirect_uri' => env('FACEBOOK_REDIRECT_URI'),
                'code' => $request->get('code')
            ];

            $url = 'https://graph.facebook.com/v18.0/oauth/access_token';

            $response = Http::post($url, $params);
            $body = json_decode($response->body());

            if(isset($body->access_token) && $body->access_token){
                $values = ['fields' => 'name,email'];
                $data = Http::withHeader('Authorization', 'Bearer ' . $body->access_token)
                    ->post('https://graph.facebook.com/v18.0/me', $values);

                    $facebookUser = json_decode($data->body());
                   $user = User::where('email', $facebookUser->email)->first();
                   if(!$user){
                       $newUser = User::create([
                           'name' => $facebookUser->name,
                           'email' => $facebookUser->email,
                           'password' => Hash::make($facebookUser->id)
                       ]);
                       Auth::guard('web')->login($newUser);
                       return redirect(route('profile'));
                   }
                Auth::guard('web')->login($user);
                return redirect(route('profile'));

            }
        }
        return redirect(route('login'));
    }
}
