<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Hash; 

class SignUpController extends Controller
{
    function index(Request $request){
        return view('sign_up.index');
    }

    function store(Request $request){
        $name = $request['name'];
        $email = $request['email'];
        $password = $request['password'];
        $passwordConfirmation = $request["passwordConfirmation"];

        if($password !== $passwordConfirmation){
            $error = "パスワードが一致しません。";
            return view('sign_up.index', compact("error"));
        }

        if (User::where('email', $email)->exists()) {
            $error = "既に登録されているメールアドレスです";
            return view("sign_up.index", compact("error"));
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        auth()->login($user);

        return redirect()->route('saves');
    }
}
