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
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('name');
            $table->float('price', 15, 2);
            $table->integer('stock')->default(0);
            $table->integer('weight')->default(0);
            $table->integer('discount')->default(0);
            $table->float('price_final', 15, 2);
            $table->text('description');
            $table->enum('status', ['available', 'soldout'])->default('available');
            $table->string('image')->default('product.jpg');
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
