<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request){
        $valid = Validator::make($request->all(),[
            'login'=>['required'],
            'password'=>['required'],
        ],[
            'login.required'=>'Поле обязательно',
            'password.required'=>'Поле обязательно',
        ]);
        if($valid->fails()){
            return response()->json($valid->errors(),400);
        }

        $user = new User();
        $user->login=$request->login;
        $user->password=md5($request->password);
        $user->save();

        return redirect()->route('welcome');
    }

    public function login(Request $request){
        $valid = Validator::make($request->all(),[
            'login'=>['required'],
            'password'=>['required'],
        ],[
            'login.required'=>'Поле обязательно',
            'password.required'=>'Поле обязательно',
        ]);
        if($valid->fails()){
            return response()->json($valid->errors(),400);
        }
        $user = User::query()->where('login',$request->login)->where('password',md5($request->password))->first();
        if($user){
            Auth::login($user);
            return redirect()->route('category');
        }else{
            return redirect()->back();
        }
    }

    public function exit(){
        Auth::logout();
        return redirect()->route('welcome');
    }
}
