<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Crea la tabla 'categories' con los campos necesarios.
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Llave primaria autoincremental (bigint unsigned)
            $table->string('name', 100); // Nombre de la categoría
            $table->text('description')->nullable(); // Descripción opcional
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
