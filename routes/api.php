<?php

// routes/api.php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController; // <-- Asegúrate de que este 'use' exista

// Rutas CRUD para productos (Ya las tienes)
Route::apiResource('products', ProductController::class);

// Rutas CRUD para categorías (¡Esta es la que falta o no está bien registrada!)
Route::apiResource('categories', CategoryController::class);