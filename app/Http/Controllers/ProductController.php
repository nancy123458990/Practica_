<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response; // Añadido para usar constantes HTTP

class ProductController extends Controller
{
    /**
     * Muestra una lista de productos.
     */
    public function index()
    {
        // Carga los productos junto con su categoría asociada
        $products = Product::with('category')->get();
        return response()->json($products);
    }

    /**
     * Guarda un nuevo producto.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:150', // Ajustado max según migración
            'description' => 'nullable|string', // Añadido tipo string
            'price' => 'required|numeric|min:0', // Añadido min:0
            'stock' => 'required|integer|min:0', // Añadido min:0
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::create($validatedData);

        return response()->json($product, Response::HTTP_CREATED); // 201
    }

    /**
     * Muestra un producto específico.
     */
    public function show(Product $product)
    {
        // Carga la categoría asociada antes de devolver la respuesta
        return response()->json($product->load('category'));
    }

    /**
     * Actualiza un producto existente.
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:150', // Ajustado max y añadido tipo string
            'description' => 'nullable|string', // Añadido tipo string
            'price' => 'sometimes|required|numeric|min:0', // Añadido min:0
            'stock' => 'sometimes|required|integer|min:0', // Añadido min:0
            'category_id' => 'sometimes|required|exists:categories,id',
        ]);

        $product->update($validatedData);

        return response()->json($product);
    }

    /**
     * Elimina un producto.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT); // 204
    }
}