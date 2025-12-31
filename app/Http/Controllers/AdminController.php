<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the admin login form
     */
    public function showLoginForm()
    {
        // Return the login view
        return view('admin.login'); // Adjust view name as needed
    }

    /**
     * Handle admin login
     */
    public function login(Request $request)
    {
        // Add your login logic here
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials)) {
            // Redirect to admin dashboard
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        return view('admin.dashboard'); // Adjust view name as needed
    }

    /**
     * Handle admin logout
     */
    public function logout()
    {
        auth()->logout();
        return redirect('/admin/login');
    }
}