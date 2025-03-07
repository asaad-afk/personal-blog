<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function register(){
        return view("auth.register");
    }
    public function login(){
        return view("auth.login");
    }
    public function registerPost(Request $request){
        $valrules = [
            "name"=>"required|string|max:255",
            "email"=>"required|string|email",
            "password"=>"required|string|min:8"
        ];
        $validator = Validator::make($request->all(),$valrules);
        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect(route("login"))->with("success","register has been successfully");
    }
    public function loginPost(Request $request){
        $credentails = [
            "email"=>$request->email,
            "password"=>$request->password,
        ];
        if(Auth::attempt($credentails)){
            $request->session()->regenerate();
            return redirect(view("home"))->with("success","credetainls are correct");
        }
        return back()->with("error","email or password are incorrect");
    }
    public function logout(Request $request){
        $user = $request->user;
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $user->delete();
        return redirect(view("auth.register"))->with("success","user has been log out successfully");
    }
}
