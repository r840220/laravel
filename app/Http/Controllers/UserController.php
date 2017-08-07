<?php

namespace shopping_mall\Http\Controllers;

use Illuminate\Http\Request;
//use shopping_mall\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use shopping_mall\Models\User;
use shopping_mall\Library\mailer;

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

    public function send_mail(){
        $email = 'r840220@yahoo.com.tw';
        $subject = '測試信';
        $body = view('mail/user')->with(['email' => $email, 'subject' => $subject]);
        $mail = new mailer();
        $mail->send($email, $subject, $body);
    }

    public function get_mail_view(){
        return view('mail/user');
    }
}
