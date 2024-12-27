<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    public function index(){
        return view('login');
    }
 
    public function login_proses(Request $request)
    {
        $request->validate([
            "email" => 'required|max:50|email|exists:users,email',
            "password" => 'required|min:4',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.max' => 'Email tidak boleh lebih dari 50 karakter.',
            'email.email' => 'Format email tidak valid.',
            'email.exists' => 'Email Tidak Sesuai',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus minimal 4 karakter.',
        ]);

        $user = User::where('email',$request->email)->first();

        $infoLogin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infoLogin)) {
            return redirect('/');

        }else{
            
            return redirect()->back()->withErrors(['password' => 'Password is Invalid']);

        }
    }

    public function logout(){

        Auth::logout();
        return redirect('/');
    }
}
