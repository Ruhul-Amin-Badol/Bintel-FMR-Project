<?php

namespace App\Http\Controllers;

use App\Models\Officer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class FrontLoginController extends Controller
{
    public function OfficerLogin(){
        return view('frontend.layouts.officer.login');
    }








    public function loginSubmit(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'password' => 'required',
        ]);

        $officer = Officer::where('employee_id', $request->employee_id)
                          ->where('password', $request->password)
                          ->first();


                        

        if ($officer) {

            Session::put('officer', $officer);
            // Store officer object in the session
            $request->session()->put('officer', $officer);
            // Set success message in session
            Session::flash('success', 'Login successful!');

            return redirect()->route('library.visit.front');
        } else {
            // Set error message in session
            Session::flash('error', 'Invalid officer ID or password');

            return redirect()->back()->withInput();
        }
    }


}
