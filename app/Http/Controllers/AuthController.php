<?php

namespace App\Http\Controllers;

use App\Http\Rules\VerifiedEmail;
use App\Mail\VerificationEmail;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store()
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
        $user->setRememberToken(Str::random(60));
        $user->save();

        Mail::to($user->email)->send(new VerificationEmail($user->remember_token, $user));
        return view('emails.verify-email', [
            'user' => $user
        ]);
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
            'email' => ['required', 'email', new VerifiedEmail],
            'password' => 'required|min:8',
        ]);

        if (auth()->attempt($validated) && auth()->user()->hasVerifiedEmail()) {
            \request()->session()->regenerate();
            return redirect()->route('ratio.home');
        }

        return back()->withErrors([
            'email' => "No matching user found with the provided email or wrong password"
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
        return redirect()->route('login')->with('success', 'You have successfully logged out');
    }

    /**
     * @param string $remember_token
     * @param User $user
     * @return RedirectResponse
     */
    public function emailVerification(string $remember_token, User $user)
    {
        if ($remember_token === $user->getRememberToken()) {
            $user->email_verified_at = CarbonImmutable::now();
            $user->setRememberToken(null);
            $user->save();
            \request()->session()->regenerate();
            return redirect()->route('ratio.home');
        }
        $this->logout();
        return redirect()->route('login');
    }

    /**
     * @param User $user
     */
    public function resendEmail(User $user)
    {
        if (!$user->hasVerifiedEmail()) {

            Mail::to($user->email)->send(new VerificationEmail($user->remember_token, $user));

            return view('emails.verify-email', [
                'user' => $user
            ]);
        } else {
            auth()->logout();
            \request()->session()->invalidate();
            \request()->session()->regenerateToken();
            return redirect()->route('login');
        }
    }
}
