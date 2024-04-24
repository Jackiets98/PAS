<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin_login'); 
    }

    public function login(Request $request)
    {
        // Validate the login request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Determine whether to remember the user or not
        $remember = $request->has('remember') ? true : false;

        // Attempt to authenticate the user using the 'web' guard
        $credentials = ['email' => $request->email, 'password' => $request->password];

        // Check if the admin has a status of 1
        $admin = Auth::guard('web')->getProvider()->retrieveByCredentials($credentials);

        // Attempt to authenticate the user using the 'web' guard
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            if($admin && $admin->status == 1) {
                // Authentication successful, redirect to the root URL
                return redirect('/')->with('info', 'Welcome Back! ');
            } else{
                return back()->withErrors(['email' => 'This account has been deactivated. Contact admin for assistance.'])->withInput($request->only('email', 'remember'));  
            }
        } else {
            // Authentication failed, redirect back to login with errors
            return back()->withErrors(['email' => 'Invalid email or password.'])->withInput($request->only('email', 'remember'));
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout(); // Log the user out
        return redirect('/'); // Redirect to the desired page after logout
    }
}