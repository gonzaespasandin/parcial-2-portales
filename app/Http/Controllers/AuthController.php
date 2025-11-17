<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }

    public function processLogin(Request $request){

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

    public function showRegister(){
        return view('auth.register');
    }

    public function processRegister(Request $request){
        $request->validate([
            'name' => 'required|string|max:30',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:4|confirmed',
        ], [
            'name.required' => 'El nombre es requerido',
            'name.string' => 'El nombre debe ser un texto',
            'name.max' => 'El nombre debe tener menos de 30 caracteres',
            'email.required' => 'El email es requerido',
            'email.email' => 'El email no es válido',
            'email.unique' => 'El email ya está registrado',
            'password.required' => 'La contraseña es requerida',
            'password.string' => 'La contraseña debe ser un texto',
            'password.min' => 'La contraseña debe tener al menos 4 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        Auth::login($user);
        
        return to_route('home')
            ->with('feedback.message',  'Bienvenido ' . e($user->name) . ', tu cuenta ha sido creada exitosamente')
            ->with('feedback.type', 'success');
    }

    public function logout(Request $request){
        
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('home')
            ->with('feedback.message', 'Has cerrado sesión correctamente.')
            ->with('feedback.type', 'success');
    }
}
