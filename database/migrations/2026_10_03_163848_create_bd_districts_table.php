<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bd_districts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('division_id')
                ->constrained('bd_divisions')
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('name_bn')->nullable();

            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();

            $table->unique([
                'division_id',
                'name',
            ]);

            $table->index('division_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bd_districts');
    }
};