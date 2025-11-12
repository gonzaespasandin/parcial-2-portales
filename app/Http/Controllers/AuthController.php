<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function show(){
        return view('auth.login');
    }

    public function process(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'El email es requerido',
            'email.email' => 'El email no es válido',
            'password.required' => 'La contraseña es requerida',
        ]);
        
        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            return to_route('home')
            ->with('feedback.message', 'Bienvenido de nuevo ' . e($request->user()->name));
        }
        return back(fallback: route('auth.login.show'))
            ->withInput()
            ->with(['feedback.message' => 'Las credenciales no coinciden con nuestros registros'])
            ->with('feedback.type', 'danger');
    }

    public function logout(Request $request){
        
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('home')
            ->with('feedback.message', 'Has cerrado sesión correctamente');
    }
}
