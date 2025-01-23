<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'firstname' => ['required', 'max:255'],
            'lastname' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'email', 'unique:users'],
            'phone_number' => ['required', 'max:11', 'regex:/^\+?[0-9]{10,15}$/'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $user = User::create($fields);

        Auth::login($user);

        return redirect()->route('home');
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => ['required', 'max:255', 'email'],
            'password' => ['required'],
        ]);
    
        if (Auth::attempt($fields, $request->remember)) {
            $user = Auth::user();
    
            // Redirect based on user type
            if ($user->usertype == 'admin') {
                return redirect()->route('admin.dashboard'); // Redirect to admin dashboard
            } else {
                return redirect()->route('user.dashboard'); // Redirect to staff dashboard
            }
        } else {
            return back()->withErrors([
                'failed' => 'The provided credentials do not match our records.'
            ]);
        }
    }
    
    

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login'); 
    }
    
    
}
