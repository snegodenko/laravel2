<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Validation\Rules\Password;
use App\Rules\MatchPassword;

class UserController extends Controller
{

    public function view(): View
    {
        $users = User::all();
        return view('users.view', ['users' => $users]);
    }


    public function create(Request $request)
    {
        if($request->isMethod('post')){

            $request->validate([
                'name' => ['required', 'min:2', 'string'],
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required', Password::min(6)]
            ]);

           $model = new User();
           $model->name = $request->input('name');
           $model->email = $request->input('email');
           $model->password = Hash::make($request->input('password'));

           if($model->save()){
               return redirect()->route('user.view');
           }
        }
        return view('users.create');
    }


    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();

        if($request->isMethod('post')){
            $request->validate([
                'name' => ['required', 'min:2', 'string'],
                'email' => ['required', 'email', 'unique:users']
            ]);
            $user->update(['name' => $request->input('name'), 'email' => $request->input('email')]);
           return redirect(route('user.update', ['id' => $id]));
        }
        return view('users.update', ['user' => $user]);
    }


    public function delete(Request $request, $id)
    {
        if($request->isMethod('get')){
            User::find($id)->delete();
            return redirect(route('user.view'));
        }
    }

    public function password(Request $request, $id)
    {
        if($request->isMethod('post')){
            $user = User::where('id', $id)->first();
            $request->validate([
                'password' => ['required', new MatchPassword($user->password)],
                'new-password' => ['required', Password::min(6)],
                'confirm-password' => ['required', 'same:new-password']
            ]);

            if($user->update(['password' => Hash::make($request->input('new-password'))])){
                $request->session()->flash('password', 'The password has been successfully changed!');
            }
        }
        return redirect(route('user.update', ['id' => $id]));
    }



}
