<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $mattress = Category::where(
            'slug',
            'mattresses'
        )->firstOrFail();

        $pillow = Category::where(
            'slug',
            'pillows'
        )->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Mattress 1
        |--------------------------------------------------------------------------
        */

        $product = Product::create([
            'category_id' => $mattress->id,

            'name' => 'Premium Memory Foam Mattress',

            'slug' => 'premium-memory-foam-mattress',

            'sku' => 'MAT-MF-001',

            'short_description' =>
                'Premium memory foam mattress designed for comfortable and restful sleep.',

            'description' =>
                'A premium memory foam mattress designed to provide excellent body support and comfortable sleep. Suitable for bedrooms, guest rooms and everyday use.',

            'regular_price' => 15000,

            'selling_price' => 12500,

            'cost_price' => 8500,

            'stock' => 50,

            'weight' => 18.5,

            'rating' => 4.8,

            'reviews_count' => 35,

            'is_featured' => true,

            'is_active' => true,
        ]);


        ProductVariant::create([
            'product_id' => $product->id,
            'name' => '3 × 6 ft / 4 inch',
            'sku' => 'MAT-MF-001-36-4',
            'size' => '3 × 6 ft',
            'thickness' => '4 inch',
            'price' => 8500,
            'stock' => 10,
        ]);

        ProductVariant::create([
            'product_id' => $product->id,
            'name' => '4 × 6 ft / 4 inch',
            'sku' => 'MAT-MF-001-46-4',
            'size' => '4 × 6 ft',
            'thickness' => '4 inch',
            'price' => 10500,
            'stock' => 15,
        ]);

        ProductVariant::create([
            'product_id' => $product->id,
            'name' => '5 × 6.5 ft / 6 inch',
            'sku' => 'MAT-MF-001-565-6',
            'size' => '5 × 6.5 ft',
            'thickness' => '6 inch',
            'price' => 15500,
            'stock' => 15,
        ]);

        ProductVariant::create([
            'product_id' => $product->id,
            'name' => '6 × 6.5 ft / 6 inch',
            'sku' => 'MAT-MF-001-665-6',
            'size' => '6 × 6.5 ft',
            'thickness' => '6 inch',
            'price' => 18500,
            'stock' => 10,
        ]);


        /*
        |--------------------------------------------------------------------------
        | Mattress 2
        |--------------------------------------------------------------------------
        */

        $product = Product::create([
            'category_id' => $mattress->id,

            'name' => 'Orthopedic Comfort Mattress',

            'slug' => 'orthopedic-comfort-mattress',

            'sku' => 'MAT-OR-001',

            'short_description' =>
                'Firm and supportive mattress designed for everyday comfort.',

            'description' =>
                'Orthopedic-style supportive mattress with a firm comfort feel.',

            'regular_price' => 18000,

            'selling_price' => 14900,

            'cost_price' => 10000,

            'stock' => 35,

            'weight' => 22,

            'rating' => 4.7,

            'reviews_count' => 21,

            'is_featured' => true,

            'is_active' => true,
        ]);

        ProductVariant::create([
            'product_id' => $product->id,
            'name' => '4 × 6 ft / 6 inch',
            'sku' => 'MAT-OR-001-46-6',
            'size' => '4 × 6 ft',
            'thickness' => '6 inch',
            'price' => 14900,
            'stock' => 10,
        ]);

        ProductVariant::create([
            'product_id' => $product->id,
            'name' => '5 × 6.5 ft / 6 inch',
            'sku' => 'MAT-OR-001-565-6',
            'size' => '5 × 6.5 ft',
            'thickness' => '6 inch',
            'price' => 17900,
            'stock' => 15,
        ]);

        ProductVariant::create([
            'product_id' => $product->id,
            'name' => '6 × 6.5 ft / 8 inch',
            'sku' => 'MAT-OR-001-665-8',
            'size' => '6 × 6.5 ft',
            'thickness' => '8 inch',
            'price' => 21900,
            'stock' => 10,
        ]);


        /*
        |--------------------------------------------------------------------------
        | Pillow 1
        |--------------------------------------------------------------------------
        */

        $product = Product::create([
            'category_id' => $pillow->id,

            'name' => 'Premium Memory Foam Pillow',

            'slug' => 'premium-memory-foam-pillow',

            'sku' => 'PIL-MF-001',

            'short_description' =>
                'Comfortable memory foam pillow with excellent head and neck support.',

            'description' =>
                'Premium memory foam pillow designed to provide comfortable support while sleeping.',

            'regular_price' => 1800,

            'selling_price' => 1450,

            'cost_price' => 800,

            'stock' => 100,

            'weight' => 1.2,

            'rating' => 4.9,

            'reviews_count' => 48,

            'is_featured' => true,

            'is_active' => true,
        ]);

        ProductVariant::create([
            'product_id' => $product->id,
            'name' => 'Standard',
            'sku' => 'PIL-MF-001-STD',
            'size' => 'Standard',
            'price' => 1450,
            'stock' => 50,
        ]);

        ProductVariant::create([
            'product_id' => $product->id,
            'name' => 'King',
            'sku' => 'PIL-MF-001-KING',
            'size' => 'King',
            'price' => 1650,
            'stock' => 50,
        ]);


        /*
        |--------------------------------------------------------------------------
        | Pillow 2
        |--------------------------------------------------------------------------
        */

        Product::create([
            'category_id' => $pillow->id,

            'name' => 'Soft Comfort Pillow',

            'slug' => 'soft-comfort-pillow',

            'sku' => 'PIL-SC-001',

            'short_description' =>
                'Soft and comfortable pillow for everyday sleeping.',

            'description' =>
                'Soft comfort pillow suitable for everyday home use.',

            'regular_price' => 1200,

            'selling_price' => 950,

            'cost_price' => 500,

            'stock' => 80,

            'weight' => 0.8,

            'rating' => 4.5,

            'reviews_count' => 26,

            'is_featured' => false,

            'is_active' => true,
        ]);
    }
}