<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bd_upazilas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('district_id')
                ->constrained('bd_districts')
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('name_bn')->nullable();

            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();

            $table->unique([
                'district_id',
                'name',
            ]);

            $table->index('district_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bd_upazilas');
    }
};