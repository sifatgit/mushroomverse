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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();            
            $table->unsignedBigInteger('product_id')->nullable();
            $table->integer('category_type');
            $table->string('product_title');
            $table->string('product_image')->nullable();
            $table->integer('product_price');
                  //$table->foreign('product_id')
                  //->references('id')
                  //->on('products')
                  //->onDelete('cascade');
            $table->foreignId('product_weight_id')
                  ->nullable()
                  ->constrained('product_weights')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
                    //$table->foreign('user_id')
                    //->references('id')
                    //->on('users')
                    //->onDelete('cascade');
            //$table->unsignedBigInteger('measurement_id')->nullable();
            $table->string('measurement_weight')->nullable();
                    //$table->foreign('measurement_id')
                    //->references('id')
                    //->on('measurements')
                    //->onDelete('cascade');
            //$table->unsignedBigInteger('brand_id')->nullable();
            $table->string('brand_name')->nullable();
                    //$table->foreign('brand_id')
                    //->references('id')
                    //->on('brands')
                    //->onDelete('cascade');
            $table->foreignId('order_id')
                  ->nullable()
                  ->constrained('orders')
                  ->onDelete('cascade');                                     
                  $table->string('ip_address')->nullable();
                  $table->integer('product_quantity')->default(1);            
                  $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
