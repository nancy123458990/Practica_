<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Category;
use App\Models\Product;

class CategoryProductRelationshipTest extends TestCase
{
    use RefreshDatabase;

    public function test_category_has_many_products()
    {
        $category = Category::create(['name' => 'Electrónica']);
        Product::create(['name' => 'Laptop', 'price' => 1200, 'stock' => 5, 'category_id' => $category->id]);
        Product::create(['name' => 'Tablet', 'price' => 600, 'stock' => 3, 'category_id' => $category->id]);

        $this->assertCount(2, $category->products);
    }
}
