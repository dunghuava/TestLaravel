<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::check()){
            return Redirect::to('/');
        }

        if($request->method() == 'POST'){
            $email = $request->email;
            $password = $request->password;
            $authorization = [
                'email' => $email,
                'password' => $password
            ];
            if(!Auth::attempt($authorization)){
                session()->flash('notify',[
                    'status'=>'error',
                    'message' => 'Email address or password is incorrect !'
                ]);
            }else{
                $redirect_url = $request->get('redirect_url','/');
                return Redirect::to($redirect_url);
            }

        }
        return view('pages.login');
    }
}