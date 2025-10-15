<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Mostrar todos los productos
    public function index()
    {
        return response()->json(Product::with('category')->get());
    }

    // Crear un producto
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::create($validated);
        return response()->json($product, 201);
    }

    // Mostrar un producto específico
    public function show(Product $product)
    {
        return response()->json($product->load('category'));
    }

    // Actualizar un producto
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required',
            'price' => 'sometimes|required|numeric',
            'stock' => 'sometimes|required|integer',
            'category_id' => 'sometimes|required|exists:categories,id',
        ]);

        $product->update($validated);
        return response()->json($product);
    }

    // Eliminar un producto
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }
}
