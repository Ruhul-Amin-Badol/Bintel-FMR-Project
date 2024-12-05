<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    
    public function login(Request $request){


    
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);


        $credentials = [
            'user_name' => $validated['email'],
            'password' => $request['password'],
        ];
        $credentials2 = [
            'email' => $validated['email'],
            'password' => $request['password'],
        ];

        if (Auth::attempt($credentials) ||  Auth::attempt($credentials2)) {

            
            return redirect()->route('dash.home');
            
        }
        else{
            return  redirect()->back()->withErrors(['msg' => 'Invalid credentials']);
        } 

    }


    public function logout(Request $request){

        return redirect(route("login"))->with(Auth::logout());
    }

    public function send(Request $request){

        dd($request->all());
    }
}
