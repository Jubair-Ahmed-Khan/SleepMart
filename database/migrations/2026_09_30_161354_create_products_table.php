<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {

            $table->id();

            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('name');

            $table->string('slug')
                ->unique();

            $table->string('sku')
                ->unique();

            $table->text('short_description')
                ->nullable();

            $table->longText('description')
                ->nullable();

            $table->decimal('regular_price', 12, 2);

            $table->decimal('selling_price', 12, 2);

            $table->decimal('cost_price', 12, 2)
                ->nullable();

            $table->unsignedInteger('stock')
                ->default(0);

            $table->decimal('weight', 8, 2)
                ->nullable();

            $table->string('thumbnail')
                ->nullable();

            $table->decimal('rating', 3, 2)
                ->default(0);

            $table->unsignedInteger('reviews_count')
                ->default(0);

            $table->boolean('is_featured')
                ->default(false);

            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();

            $table->index([
                'category_id',
                'is_active'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};