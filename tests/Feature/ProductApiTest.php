<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;

class ProductApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Ejecuta todas las migraciones en la base de datos de pruebas
        $this->artisan('migrate');
    }

    public function test_can_create_product()
    {
        $category = Category::create(['name' => 'Electrónica']);

        $response = $this->postJson('/api/products', [
            'name' => 'Smartphone',
            'price' => 499.99,
            'stock' => 10,
            'category_id' => $category->id,
        ]);

        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'Smartphone']);
    }

    public function test_can_fetch_products()
    {
        $category = Category::create(['name' => 'Electrónica']);
        Product::create([
            'name' => 'Laptop',
            'price' => 1200,
            'stock' => 5,
            'category_id' => $category->id,
        ]);

        $response = $this->getJson('/api/products');
        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Laptop']);
    }
}
