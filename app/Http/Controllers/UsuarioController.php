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

    public function list()
    {
        // Obtener todos los usuarios
        $usuarios = Usuario::all();

        // Retornar la lista de usuarios en formato JSON
        return response()->json(['usuarios' => $usuarios], 200);
    }

    public function getUserByEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Buscar el usuario por su correo electrónico
        $usuario = Usuario::where('email', $request->email)->first();

        // Verificar si se encontró el usuario
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Crear un arreglo con la información del usuario excluyendo la contraseña
        $userInfo = [
            'id' => $usuario->id,
            'email' => $usuario->email,
            'nombre' => $usuario->nombre ?: 'Completa tu información',
            'apellido' => $usuario->apellido ?: 'Completa tu información',
            'telefono' => $usuario->telefono ?: 'Completa tu información',
            'id_rol' => $usuario->id_rol,
            'foto' => $usuario->foto ?: 'Completa tu información',
            // Puedes agregar otros campos según sea necesario
        ];

        // Retornar la información del usuario en formato JSON
        return response()->json($userInfo, 200);
    }

    public function updateUserInfoByEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'nombre' => 'nullable|string',
            'apellido' => 'nullable|string',
            'telefono' => 'nullable|string',
            'foto' => 'nullable|string',  // Suponiendo que 'foto' es una cadena que representa la URL o nombre de archivo
        ]);

        // Buscar el usuario por su correo electrónico
        $usuario = Usuario::where('email', $request->email)->first();

        // Verificar si se encontró el usuario
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Actualizar la información del usuario si se proporciona en la solicitud
        if ($request->has('nombre')) {
            $usuario->nombre = $request->nombre;
        }

        if ($request->has('apellido')) {
            $usuario->apellido = $request->apellido;
        }

        if ($request->has('telefono')) {
            $usuario->telefono = $request->telefono;
        }

        if ($request->has('foto')) {
            $usuario->foto = $request->foto;
        }

        // Intentar guardar los cambios en el usuario en la base de datos
        try {
            $usuario->save();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la información del usuario'], 500);
        }

        // Mensaje de actualización exitosa
        $mensaje = 'Información del usuario actualizada con éxito.';

        return response()->json(['success' => true, 'message' => $mensaje], 200);
    }
}
