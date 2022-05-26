<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function login(Request $request)
    {
        if ($request->method() == 'POST') {
            $email = $request->email;
            $password = $request->password;
            $authorization = [
                'email' => $email,
                'password' => $password,
                'type' => 0
            ];
            if (!Auth::attempt($authorization)) {
                session()->flash('notify', [
                    'status' => 'error',
                    'message' => 'Email address or password is incorrect !'
                ]);
            } else {
                $redirect_url = $request->get('redirect_url', '/');
                return Redirect::to($redirect_url);
            }

        }
        return view('pages.login');
    }

    public function signup(Request $request)
    {
        if ($request->method() == 'POST') {
            $name = $request->name;
            $email = $request->email;
            $password = $request->password;
            $password_confirm = $request->password_confirm;
            if ($password_confirm != $password) {
                session()->flash('notify', [
                    'status' => 'error',
                    'message' => 'Password does not match !'
                ]);
                return Redirect::back();
            }
            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->password = bcrypt($password);
            if ($user->save()) {
                session()->flash('notify', [
                    'status' => 'success',
                    'message' => 'Account registration successful !'
                ]);
                return Redirect::to('/user/login');
            }
            return Redirect::back();
        }
        return view('pages.signup');
    }

    public function adminLogin(Request $request)
    {
        if (Auth::check() && Auth::user()->type == 1) {
            return Redirect::to('/administrator');
        }

        if ($request->method() == 'POST') {
            $email = $request->email;
            $password = $request->password;
            $authorization = [
                'email' => $email,
                'password' => $password,
                'type' => 1
            ];
            if (!Auth::attempt($authorization)) {
                session()->flash('notify', [
                    'status' => 'error',
                    'message' => 'Email address or password is incorrect !'
                ]);
            } else {
                $redirect_url = $request->get('redirect_url', '/');
                return Redirect::to($redirect_url);
            }

        }
        return view('administrators.login');
    }
}
