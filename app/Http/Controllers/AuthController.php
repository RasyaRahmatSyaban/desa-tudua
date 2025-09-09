<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user) {
                return redirect()->route('admin.dashboard');
            } else {
                auth()->logout();
                return redirect()->route('home')->with('error', 'Role tidak dikenal');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }
    public function resetPassword(Request $request)
    {
        $request->validate(['email' => 'required']);
        User::where('email', $request->email)->update(['password' => bcrypt('@Tudua123')]);
        return redirect()->route('auth.login');
    }
}