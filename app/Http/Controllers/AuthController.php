<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Error;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function login_store(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'password' => 'required',
    ]);

    try {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('backend.dashboard')->with('success', 'Welcome to Dashboard');
        } else {
            return redirect()->back()->withErrors(['password' => 'Invalid credentials provided.']);
        }
    } catch (Exception $ex) {
        $url = URL::current();
        Error::create(['url' => $url, 'message' => $ex->getMessage()]);
        return redirect()->back()->with('error', 'An unexpected error occurred. Please try again later.');
    }
}



    public function logout()
    {
        Auth::logout();   
        return redirect()->route('login'); 
    }
}
