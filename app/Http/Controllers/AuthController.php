<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getSignUp(){
        return view('auth.signUp');
    }
    public function PostSignUp(Request $request){
        $this->validate($request,[
            'userName'=>'required',
            'email'=>'required',
            'password'=>'required|min:6',
            'confirmPassword'=>'required|min:6|same:password'
        ]);
        $user=new User();
        $user->name=$request['userName'];
        $user->email=$request['email'];
        $user->password=bcrypt($request['password']);
        $user->save();
        return redirect()->back()->with('success','Sign Up Successfully!');
    }
    public function getLogin(){
        return view('auth.login');
    }
    public function PostLogin(Request $request){
        $this->validate($request,[
            'userName'=>'required',
            'password'=>'required',
        ]);
        $name=$request['userName'];
        $password=$request['password'];
        if(Auth::attempt(['name'=>$name,'password'=>$password])){
            return redirect()->route('dashboard');
        }
        else{
            return redirect()->back()->with('error','Login Fail Try Again!');

        }
    }
    public function getLogout(){
        Auth::logout();
        return redirect()->route('/');
    }

}
