<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLogin()
    {
        return view('admin.login');
    }

    /**
     * Handle an admin login request.
     * Validates username/password and redirects to admin page on success.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return  view('admin.dashboard');
        }

        return back()->withErrors(['username' => 'Username atau password salah'])->withInput($request->only('username'));
    }

    public function tambahAkun()
    {
        return view('admin.tambahakun');
    }
}
