<?php

namespace shopping_mall\Http\Controllers;

use Illuminate\Http\Request;
//use shopping_mall\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use shopping_mall\Models\User;
use Session;

class UserController extends Controller
{
    public function getSignup(){
        return view('user.signup');
    }

    public function postSignup(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email|required|unique:users',
            'password' => 'required|min:6'
        ],[
            'name.required' => '姓名為必填欄位',
            'email.required' => '信箱為必填欄位',
            'email.email' => '信箱格式不符',
            'email.unique' => '信箱已經註冊過',
            'password.required' => '密碼為必填欄位',
            'password.min' => '密碼必須大於六碼'
        ]);

        //將這段存進MODELS/USER
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Bcrypt($request->input('password'))
        ]);

        $user->save();
        return redirect()->route('ProductController.index');
    }

    public function  getSignin(){
        return view('user.signin');
    }

    public function postSignin(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ],[
            'email.required' => '信箱為必填欄位!!',
            'email.email' => '信箱格式不符',
            'password.required' => '密碼為必填欄位',
        ]);

        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ])){
            return redirect()->route('user.profile');
        }else{

            $message = new MessageBag(['errors' => '帳號密碼錯誤']);
            return redirect()->back()->withErrors($message);
        }
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->back();
    }

    public function profile(){
        return view('user/profile');
    }
}
