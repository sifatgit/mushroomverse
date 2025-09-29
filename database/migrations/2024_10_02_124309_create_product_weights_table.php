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
        Schema::create('product_weights', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreignId('product_id')
                  ->nullable()
                  ->constrained('products')
                  ->onDelete('cascade');
            $table->integer('brand_id')->nullable();
            $table->unsignedBigInteger('measurement_id')->nullable();
            $table->foreignId('measurement_id')
                  ->nullable()
                  ->constrained('measurements')
                  ->onDelete('cascade');
            $table->integer('price');
            $table->integer('availability')->default(0);
            $table->integer('quantity')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_weights');
    }
};
