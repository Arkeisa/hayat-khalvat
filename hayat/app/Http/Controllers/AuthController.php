<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
        // Store the previous URL in session if coming from cart
        if(url()->previous() && str_contains(url()->previous(), 'addcart')) {
            session(['url.intended' => url()->previous()]);
        }

        return view('pages.userlogin');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        try {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                Log::info('Login successful for user: ' . $request->email);

                return redirect('/')->with('success', 'خوش آمدید!');  // Redirect to main page
            }

            Log::info('Login failed for user: ' . $request->email);
            return back()->withErrors([
                'email' => 'ایمیل یا رمز عبور اشتباه است.',
            ])->withInput();

        } catch (\Exception $e) {
            Log::error('Login exception: ' . $e->getMessage());
            return back()->withErrors([
                'email' => 'خطا در ورود به سیستم.',
            ])->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }


    public function showRegisterForm()
    {
        return view('pages.register'); // Points to your custom registration Blade file
    }

    public function register(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'phone' => 'required|string|max:11',
                'password' => 'required|string|min:6|confirmed',
            ]);

            // Create the user
            $user = User::create([
                'name' => $validated['name'],
                'lastname' => $validated['lastname'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'password' => Hash::make($validated['password']),
            ]);

            if (!$user) {
                return back()->with('error', 'Failed to create user.');
            }

            // Log in the user
            Auth::login($user);

            // Redirect to dashboard
            return redirect('/dash')->with('success', 'Registration successful!');

        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Registration error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Registration failed. Please try again.'])
                        ->withInput($request->except('password', 'password_confirmation'));
        }
    }
}
