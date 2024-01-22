<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function all(): UserCollection
    {
        return new UserCollection(User::all());
    }


    public function one(Request $request, $id)
    {
        return new UserResource(User::where('id', $id)->first());
    }

    public function create(Request $request)
    {
        if($request->isMethod('post')){
            if(empty($request->input('name')) || empty($request->input('email'))){
                return response('Error', 400);
            }
            $data = $request->validate($this->rules());
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['name'])
            ]);

            return new UserResource($user);
        }
    }


    public function update(Request $request)
    {
        if(!$request->input('id') || !$user = User::where('id', $request->input('id'))->first()){
            return response('Error', 400);
        }
        $data = $request->validate($this->rules());
        $user->update(['name' => $data['name'], 'email' => $data['email']]);
        return new UserResource($user);
    }

    protected function rules(): array
    {
        return [
            'name' => ['string', 'min:2'],
            'email' => ['email']
        ];
    }


}
