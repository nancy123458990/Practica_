<?php

// Corregido: Se eliminó la duplicación "{namespace App\Http"
namespace App\Http\Controllers;

use App\Models\Category; // ¡Asegúrate de importar el modelo!
use Illuminate\Http\Request;
use Illuminate\Http\Response; // Necesario para el código de estado 204

class CategoryController extends Controller
{
    // Método para listar todas las categorías (GET /api/categories)
    public function index()
    {
        // Añadimos 'with('products')' para cargar también los productos asociados
        return response()->json(Category::with('products')->get());
    }

    // Método para crear una nueva categoría (POST /api/categories)
    public function store(Request $request)
    {
        // 1. Validar los datos de entrada
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name', // Añadido unique para evitar nombres duplicados
            'description' => 'nullable|string',
        ]);

        // 2. Crear y guardar la categoría
        $category = Category::create($validated);

        // 3. Devolver la respuesta de éxito
        return response()->json($category, Response::HTTP_CREATED); // 201 Created
    }

    // Método para mostrar una categoría específica (GET /api/categories/{category})
    public function show(Category $category)
    {
        // Carga los productos relacionados con la categoría antes de devolverla
        return response()->json($category->load('products'));
    }

    // Método para actualizar una categoría existente (PUT/PATCH /api/categories/{category})
    public function update(Request $request, Category $category)
    {
        // 1. Validar los datos de entrada
        $validated = $request->validate([
             // 'sometimes' asegura que solo se valide si el campo está presente
            'name' => 'sometimes|required|string|max:100|unique:categories,name,'.$category->id, // Ignora el id actual al validar unicidad
            'description' => 'nullable|string',
        ]);

        // 2. Actualizar la categoría
        $category->update($validated);

        // 3. Devolver la categoría actualizada
        return response()->json($category);
    }

    // Método para eliminar una categoría (DELETE /api/categories/{category})
    public function destroy(Category $category)
    {
        // Eliminar la categoría (los productos asociados se eliminarán en cascada si así se definió en la migración)
        $category->delete();

        // Devolver una respuesta sin contenido (éxito)
        return response()->json(null, Response::HTTP_NO_CONTENT); // 204 No Content
    }
}