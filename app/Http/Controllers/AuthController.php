<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    /**
     * @return RedirectResponse
     */
    public function store(): RedirectResponse
    {
        $validated = \request()->validate([
            'name' => 'required|min:3|max:40',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Mail::to($user->email)->send(new WelcomeEmail($user));

        \request()->session()->regenerate();
        return redirect()->route('ratio.home');
    }

    public function login()
    {
        return view('auth.login');
    }

    /**
     * @return RedirectResponse
     */
    public function authenticate(): RedirectResponse
    {
        $validated = \request()->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (auth()->attempt($validated)) {
            \request()->session()->regenerate();
            return redirect()->route('ratio.home');
        }

        return back()->withErrors([
            'email' => "No matching user found with the provited email or wrong password"
        ]);
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        auth()->logout();
        \request()->session()->invalidate();
        \request()->session()->regenerateToken();
        return redirect()->route('login');
    }
}
