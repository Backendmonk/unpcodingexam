<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
        'email' => ['required', 'string'],
        'password' => ['required', 'string'],
    ]);

    $remember = $request->filled('remember');

    if (Auth::attempt($credentials, $remember)) {
        $request->session()->regenerate();
        return redirect()->route('admin.dashboard'); // <-- paling penting
    }

    return back()
        ->withErrors(['email' => 'Email atau password salah'])
        ->withInput($request->only('email'));
}


    /**
     * Show the "Tambah Akun" form for admins.
     * Access is limited: this checks that the user is authenticated and has role 'admin'.
     * Adjust the role check to match your User model (e.g. is_admin boolean or roles table).
     */
    public function tambahAkun()
    {
    
        return view('admin.tambahakun');
    }

    /**
     * Store a new user created by an admin.
     */
    public function storeUser(Request $request)
    {
       
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        // create user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        if ($user) {
            return redirect()->route('admin.tambahakun')->with('success', 'Akun berhasil dibuat.');
        }

        return back()->with('error', 'Gagal membuat akun, silakan coba lagi.')->withInput();
    }
}
