<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        /** @var \App\Models\User $user */
        $user->load(['purchases.product']);
        return view('profile.index', [
            'user' => $user,
        ]);
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request)
    {
        try {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:30',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ],
        [
            'name.required' => 'El nombre es requerido',
            'name.string' => 'El nombre debe ser un texto',
            'name.max' => 'El nombre debe tener menos de 30 caracteres',
            'email.required' => 'El email es requerido',
            'email.email' => 'El email no es válido',
            'email.unique' => 'El email ya está en uso',
        ]);

        $data = $request->only(['name', 'email']);

        /** @var \App\Models\User $user */
        $user->update($data);

        return to_route('profile.index')
            ->with('feedback.message', 'Tu perfil se ha actualizado correctamente')
            ->with('feedback.type', 'success');
        } catch (\Throwable $th) {
            throw $th;
            return to_route('profile.edit')
                ->with('feedback.message', 'Error al actualizar el perfil')
                ->with('feedback.type', 'danger')
                ->withInput();
        }
    }
}
