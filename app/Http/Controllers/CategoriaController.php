<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function list()
    {
        // Obtener todas las categorías
        $categorias = Categoria::all();

        // Retornar la lista de categorías en formato JSON
        return response()->json(['categorias' => $categorias], 200);
    }

    // Otros métodos del controlador, como el método show, update, store, destroy, pueden ir aquí
}
