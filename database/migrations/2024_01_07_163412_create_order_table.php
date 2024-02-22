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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->integer('quantity')->nullable();
            $table->decimal('sub_total', 15, 2)->nullable();
            $table->text('note')->nullable();
            $table->decimal('shipping_cost', 15, 2)->nullable();
            $table->decimal('grand_total', 15, 2)->nullable();
            $table->string('snap_token')->nullable();
            $table->enum('status_payment', ['paid', 'unpaid'])->default('unpaid');
            $table->enum('status_delivery', ['process', 'shipping', 'completed'])->default('process');
            $table->string('number_track')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
