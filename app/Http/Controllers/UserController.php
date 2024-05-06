<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function reg(Request $request){

            $request->validate([
                'login'=>['required', 'regex:/[A-Za-z -]/u'],
                'password'=>['required','confirmed'],
                'rule'=>['required'],
            ]);

            $user = new User();
            $user->login=$request->login;
            $user->password=md5($request->password);
            $user->save();

            if($user){
                Auth::login($user);
            }

        return redirect()->route('category');
    }
    public function auth(Request $request){
        $request->validate([
            'login'=>['required'],
            'password'=>['required']
        ]);
        $user = User::query()->
        where('login',$request->login)->
        where('password', md5($request->password))->first();


        if($user){
            Auth::login($user);
            if($user->role == 0){
                return redirect()->route('category');
            }
        }else{
            return redirect()->route('welcome')->with('error', 'Неверный логин или пароль');
        }
    }

    public function exit(){
        Auth::logout();
        return redirect()->route('welcome');
    }
}
