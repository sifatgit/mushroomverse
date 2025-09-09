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
            $table->unsignedBigInteger('category_id')->nullable();
                $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
            $table->unsignedBigInteger('brand_id')->nullable();
                $table->foreign('brand_id')
                ->references('id')
                ->on('brands')
                ->onDelete('cascade');
            $table->string('title');
            $table->string('images');
            $table->integer('price');
            $table->text('description');
            $table->string('slug');
            $table->string('quantity')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->integer('offer_price')->nullable();
            $table->integer('admin_id')->unsigned();   
            $table->tinyInteger('featured')->default(0);   
            $table->tinyInteger('sale')->default(0);   
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
