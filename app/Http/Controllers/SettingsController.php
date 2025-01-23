<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class SettingsController extends Controller
{
    public function password(){
        $users = User::All();
        return view('admin.settings.password', compact('users'));
    }


public function updateSettings(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'phone_number' => ['nullable', 'string', 'max:15'], 
        'current_password' => ['required_with:new_password', 'current_password'], 
        'new_password' => ['nullable', 'string', 'min:8', 'confirmed'], 
    ]);
    if ($request->filled('phone_number')) {
        $user->phone = $request->phone;
    }

    if ($request->filled('new_password')) {
        $user->password = Hash::make($request->new_password);
    }

    $user->save();

    return back()->with('success', 'Profile updated successfully.');
}


}
