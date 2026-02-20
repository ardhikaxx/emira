<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = \App\Models\User::where('email', $credentials['email'])->first();

        if (!$user || !$user->is_active) {
            return back()->withErrors(['email' => 'Akun tidak aktif atau tidak ditemukan.']);
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user->update(['last_login_at' => now()]);
            
            ActivityLog::create([
                'user_id' => $user->id,
                'action' => 'login',
                'module' => 'auth',
                'deskripsi' => 'User login ke sistem',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'created_at' => now(),
            ]);

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        
        if ($user) {
            ActivityLog::create([
                'user_id' => $user->id,
                'action' => 'logout',
                'module' => 'auth',
                'deskripsi' => 'User logout dari sistem',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'created_at' => now(),
            ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
