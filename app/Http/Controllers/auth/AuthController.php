<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show login form
    public function showLoginForm(): View|Factory|Application
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            // Vérifier si l'utilisateur est bloqué (is_active = false)
            if (!Auth::user()->is_active) {
                Auth::logout();
                return redirect('/login')->withErrors(['email' => 'Votre compte est bloqué. Contactez un administrateur.']);
            }
    
            return redirect()->intended('/')->with('success', 'Welcome back!');
        }
    
        return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
    }
    

    // Show register form
    public function showRegisterForm(): View|Factory|Application
    {
        return view('auth.register');
    }

    // Handle registration
    public function register(Request $request): Application|Redirector|RedirectResponse
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'Guest',
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Account created successfully!');
    }

    // Handle logout
    public function logout(): Application|Redirector|RedirectResponse
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Logged out successfully.');
    }
}
