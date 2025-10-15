<?php

namespace App\Http\Controllers;

use App\Models\Category; // ¡Asegúrate de importar el modelo!
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Método para crear una nueva categoría
    public function store(Request $request)
    {
        // 1. Validar los datos de entrada
        $validated = $request->validate([
            // 'name' y 'description' son los campos que envías por JSON
            'name' => 'required|string|max:100', 
            'description' => 'nullable|string', 
        ]);

        // 2. Crear y guardar la categoría
        $category = Category::create($validated);
        
        // 3. Devolver la respuesta de éxito
        return response()->json($category, 201); // 201 Created
    }
    
    // Si quieres listar categorías para verificar (GET /api/categories)
    public function index()
    {
        return response()->json(Category::all());
    }

    // ... (Puedes dejar los otros métodos (show, update, destroy) vacíos por ahora, pero store e index son clave)
}