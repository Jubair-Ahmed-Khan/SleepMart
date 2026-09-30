<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Mattresses',
            'slug' => 'mattresses',
            'description' => 'Comfortable mattresses for restful sleep.',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Category::create([
            'name' => 'Pillows',
            'slug' => 'pillows',
            'description' => 'Comfortable pillows for better head and neck support.',
            'is_active' => true,
            'sort_order' => 2,
        ]);
    }
}