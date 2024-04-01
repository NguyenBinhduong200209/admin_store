<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id()->primary();;
            $table->string('name');
            $table->decimal('price', 10, 2); // Change 10, 2 to match your precision and scale
            $table->text('description');
            $table->text('details');
            $table->string('category');
            $table->enum('status', ['Còn hàng', 'Hàng chưa về', 'Đã hết'])->default('Còn hàng');
            $table->string('image')->nullable(); //
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
