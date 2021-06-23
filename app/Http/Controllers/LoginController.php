<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Handlers\PostHandler;
use App\Http\Handlers\UserHandler;


class LoginController extends Controller
{
    public function signin()
    {
        return view('signin');
    }

    public function signinAction(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($token = UserHandler::verifyLogin($request->email, $request->password)) {
            if ($token) {
                $_SESSION['token'] = $token;
                return redirect()->route('index');
            } else {
                return redirect()->route('login.signin')->with('warning', 'E-mail e/ou senha não conferem.');
            }
        } else {
            return redirect()->route('login.signin')->with('warning', 'E-mail e/ou senha não conferem.');
        }
    }

    public function signup()
    {
        return view('signup');
    }
}
