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
                  ->constrained('categories')
                  ->cascadeOnDelete();

            $table->string('name');
            $table->string('slug')->unique();

            $table->enum('gender', ['Men', 'Women', 'Unisex'])
                  ->default('Unisex');

            $table->decimal('price', 10, 2);
            $table->decimal('discount_price', 10, 2)->nullable();

            $table->text('description')->nullable();

            $table->text('top_notes')->nullable();
            $table->text('heart_notes')->nullable();
            $table->text('base_notes')->nullable();

            $table->unsignedInteger('stock')->default(0);

            $table->string('image')->nullable();

            $table->enum('status', ['active', 'inactive'])
                  ->default('active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};