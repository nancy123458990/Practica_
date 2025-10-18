<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Muestra una lista de categorías.
     */
    public function index()
    {
        // Carga las categorías junto con sus productos relacionados
        $categories = Category::with('products')->get();
        return response()->json($categories);
    }

    /**
     * Guarda una nueva categoría.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        $category = Category::create($validatedData);

        return response()->json($category, Response::HTTP_CREATED); // 201
    }

    /**
     * Muestra una categoría específica.
     */
    public function show(Category $category)
    {
        // Carga los productos asociados antes de devolver la respuesta
        return response()->json($category->load('products'));
    }

    /**
     * Actualiza una categoría existente.
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:100|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($validatedData);

        return response()->json($category);
    }

    /**
     * Elimina una categoría.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT); // 204
    }
}