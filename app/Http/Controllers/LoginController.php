<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index ()
    {
        return view ('login.blade.php');
    }
    public function aunthanticate(Request $request)
    {
        $login = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = Auth::attempt($login);
        
        if (!$user) {
            return back()->with('danger', 'login failed');
        }

        if (Auth::user()->role == 'Admin'){
            return redirect()->route('admin')->with('success', 'You are logged in');
        }

        elseif (Auth::user()->role == 'Manager'){
            return redirect()->route('manager')->with('success', 'You are logged in');

        }

        elseif (Auth::user()->role == 'Kasir'){
            return redirect()->route('kasir')->with('success', 'You are logged in');

        }
    }
}
