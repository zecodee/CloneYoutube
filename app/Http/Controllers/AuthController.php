<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.authenticate', [
            'title' => 'Sign In & Sign Up',
        ]);
    }

    // FOR LOGIN
    public function auth(Request $request)
    {
        $auth = $request->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($auth)) {
            return redirect('/');
        }

        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    // FOR REGISTRATION
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:8|max:255',
            'username' => 'required|unique:users|min:8|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['level'] = 'user';
        $validatedData['image'] = null;

        User::create($validatedData);

        return redirect('/auth');
    }
}
