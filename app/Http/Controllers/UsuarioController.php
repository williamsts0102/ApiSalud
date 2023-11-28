<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|unique:usuarios,email',
            'password' => 'nullable|string',
        ]);

        // Crear un nuevo usuario
        $usuario = new Usuario();
        $usuario->email = $request->email;
        $usuario->password = $request->password ? Hash::make($request->password) : null;
        // Agregar otros campos del usuario según sea necesario

        // Intentar guardar el usuario en la base de datos
        try {
            $usuario->save();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al registrar el usuario'], 500);
        }

        // Mensaje de registro exitoso
        $mensaje = 'Registro exitoso.';

        return response()->json(['success' => true, 'message' => $mensaje], 201);
    }

    // Otros métodos del controlador, como el método login, pueden ir aquí
}
