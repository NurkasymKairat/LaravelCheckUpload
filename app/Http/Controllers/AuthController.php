<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return redirect('/register')->withErrors($validator, 'registration')->withInput();
        }

       $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        Auth::loginUsingId($user->id, 1);

        return redirect('/');
    }

    public function login_store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return redirect('/login')->withErrors($validator, 'login')->withInput();
        }



        $credentials = $request->only('email', 'password');


        if (Auth::attempt($credentials)) {
            return redirect('/');
        }

        return redirect('/login')->withErrors(['login' => 'Неверный email или пароль'])->withInput();
    }
}
