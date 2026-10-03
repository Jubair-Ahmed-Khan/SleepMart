<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('order_number')->unique();

            // Customer information
            $table->string('name');
            $table->string('phone', 30);
            $table->string('email')->nullable();

            // Bangladesh delivery address
            $table->string('division');
            $table->string('district');
            $table->string('upazila');
            $table->text('address');

            $table->text('delivery_note')->nullable();

            // Amounts
            $table->decimal('subtotal', 12, 2);
            $table->decimal('shipping_charge', 12, 2)->default(0);
            $table->decimal('total', 12, 2);

            // Payment
            $table->string('payment_method', 50)
                ->default('cod');

            $table->string('payment_status', 30)
                ->default('pending');

            // Order
            $table->string('order_status', 30)
                ->default('pending');

            $table->timestamps();

            $table->index('phone');
            $table->index('order_status');
            $table->index('payment_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};