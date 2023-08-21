<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index() {
        $data['title'] = 'Charm - Login';
        return view('pages.auth.login', $data);
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ],
        ['name.required' => 'Username harus di isi',
         'password.required' => 'Password harus di isi']);

        if (Auth::attempt(['name' => $request->name, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'password' => 'Username atau password salah',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
