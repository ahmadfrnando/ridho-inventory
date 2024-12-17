<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $redirectTo = '/dashboard';
    public function index()
    {
        return view('login', ['title' => 'Login']);
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // Redirect ke dashboard jika sukses
            return redirect()->route('dashboard');
        } else {
            // Redirect kembali ke form login dengan error
            return back()->withErrors(['loginError' => 'Username atau password salah.']);
        }
    }

    public function dashboard()
    {
        return view('dashboard', ['title' => 'Dashboard']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}