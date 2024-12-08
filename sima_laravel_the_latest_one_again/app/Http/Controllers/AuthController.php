<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\AuthModel;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        if(Auth::user()){
            return redirect()->route('home');
        }
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Mohon cek kembali data yang anda masukan!');
            }

            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                return redirect()->route('home')->with('success', 'Login successful!');
            }
            return redirect()->back()->with('error', 'Invalid credentials.');
        }

        return view('auth.login');
    }

    public function register(Request $request)
    {
        if(Auth::user()){
            return redirect()->route('home');
        }
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'nama_lengkap' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            AuthModel::create([
                'name' => $request->input('nama_lengkap'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password'))
            ]);

            return redirect()->route('auth.login')->with('success', 'Registration successful! Please login.');
        }
        return view('auth.register');
    }

    public function forgot_password(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Simulasi pengiriman email reset password
            // Biasanya kita gunakan Jobs atau Notification untuk proses ini
            // Tetapi disini hanya akan ada pesan sukses
            return redirect()->route('login')->with('success', 'Password reset link sent to your email.');
        }

        return view('auth.forget_password');
    }
    public function logout(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    public function sendOtpForgetPassword(Request $request){

    }
}
