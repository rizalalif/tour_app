<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registerPage()
    {
        return view('auth.register');
    }
    public function loginPage()
    {
        return view('auth.login');
    }
    public function createAccount(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        // $data = $request->all();
        $validated['password'] = bcrypt($validated['password']);


        $newUser = User::create($validated);

        dd($newUser);


        session()->flash('success', 'Register successfully!.');
        return redirect()->route('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // $validated = $request->validated();

        // $credentials = ['email' => $validated['email'], 'password' => $validated['password']];
        // dd($credentials);
        if (Auth::attempt($credentials)) {
            // if (Auth::user()->isAdmin == 1) {
            //     return redirect('/admin')->with('title', 'Dashboard');
            // } else

            // dd(Auth::user()->isAdmin);
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return redirect('/login')->with('login-failed', 'Login Failed');
    }
}
