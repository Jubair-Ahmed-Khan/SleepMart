<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Mattresses',
                'slug' => 'mattresses',
                'icon' => '🛏️',
                'image' => null,
                'description' => 'Comfortable mattresses designed for better sleep.',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Pillows',
                'slug' => 'pillows',
                'icon' => '💤',
                'image' => null,
                'description' => 'Supportive and comfortable pillows for restful sleep.',
                'is_active' => true,
                'sort_order' => 2,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}