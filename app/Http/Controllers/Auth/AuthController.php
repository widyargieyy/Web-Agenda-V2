<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Console\View\Components\Alert;

class AuthController extends Controller
{
    public function toLogin()
    {
        return view('auth.login');
    }

    public function loginProses(Request $request)
    {
        // Validasi
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba login
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect berdasarkan role
            switch ($user->role_id) {
                case 1: // Admin
                    // Alert::success('Login Berhasil', 'Selamat datang Admin');
                     return redirect()->intended(route('admin.dashboard'));

                case 2: // Operator
                    // Alert::success('Login Berhasil', 'Selamat datang Operator');
                    return redirect()->intended(route('operator.dashboard'));

                case 3: // Kabid
                    // Alert::success('Login Berhasil', 'Selamat datang Kabid');
                    return redirect()->intended(route('kabid.dashboard'));

                case 4: // Staff
                    // Alert::success('Login Berhasil', 'Selamat datang Staff');
                    return redirect()->intended(route('staff.dashboard'));

                default:
                    Auth::logout();
                    // Alert::error('Error', 'Role tidak dikenali');
                    return redirect()->route('login');
            }
        }

        // Jika gagal login
        // Alert::error('Gagal', 'Email atau Password salah');
        return back()->withInput()->with('error', 'Email Atau Password Salah!');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}