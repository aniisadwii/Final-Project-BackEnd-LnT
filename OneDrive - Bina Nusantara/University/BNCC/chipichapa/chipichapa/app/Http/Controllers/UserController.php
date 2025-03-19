<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function createUser(Request $request){
        $request->validate([
            'name' => 'required|string|min:3|max:40',
            'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i|unique:users,email',
            'password' => 'required|string|min:6|max:12',
            'phone' => 'required|string|regex:/^08[0-9]{8,12}$/|unique:users,phone_number',
        ]);
        

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'phone_number' => $request->phone, // Sesuaikan dengan nama field di form HTML
        ]);
    
        return redirect('/login');
    }

    public function register(){
        return view('register');
    }

    public function login(){
        return view('login');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/items');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match'
        ])->onlyInput('email');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
