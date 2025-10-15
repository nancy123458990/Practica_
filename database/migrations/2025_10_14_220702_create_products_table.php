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
        // Crea la tabla 'products'
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Llave primaria
            $table->string('name', 150);
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2); // Precio con 8 dígitos totales y 2 decimales
            $table->integer('stock')->default(0);

            // Llave foránea que referencia a la tabla 'categories'
            $table->foreignId('category_id')
                  ->constrained('categories') // Se asegura que el id exista en la tabla categories
                  ->onUpdate('cascade') // Si el id de la categoría cambia, se actualiza aquí
                  ->onDelete('cascade'); // Si la categoría se elimina, los productos asociados también

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
