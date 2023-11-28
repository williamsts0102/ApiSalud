<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Medicamento;
use Illuminate\Http\Request;

class MedicamentoController extends Controller
{
    public function list()
    {
        // Obtener todos los medicamentos
        $medicamentos = Medicamento::all();

        // Retornar la lista de medicamentos en formato JSON
        return response()->json(['medicamentos' => $medicamentos], 200);
    }

    public function listByCategory(Request $request, $categoria)
    {
        // Buscar la categoría por descripción
        $categoriaModel = Categoria::where('descripcion', $categoria)->first();

        if (!$categoriaModel) {
            return response()->json(['error' => 'Categoría no encontrada'], 404);
        }

        // Obtener los medicamentos de la categoría
        $medicamentos = $categoriaModel->medicamentos;

        // Retornar la lista de medicamentos de la categoría en formato JSON
        return response()->json(['medicamentos' => $medicamentos], 200);
    }
    // Otros métodos del controlador, como el método show, update, store, destroy, pueden ir aquí
}
