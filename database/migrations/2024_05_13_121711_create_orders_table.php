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
                  //$table->unsignedBigInteger('user_id')->nullable();
                  $table->integer('product_id')->nullable();
                  $table->string('product_title')->nullable();
                  $table->string('product_image')->nullable();
                  $table->integer('product_price')->nullable();
                  $table->integer('product_weight')->nullable();
                  $table->string('product_brand')->nullable();
                  //$table->foreign('user_id')
                  //->references('id')
                  //->on('users')
                  //->onDelete('cascade');
                  $table->string('name');
                  $table->string('phone_no');
                  $table->string('email');
                  //$table->integer('division_id')->nullable();
                  $table->string('division_name')->nullable();
                  //$table->integer('district_id')->nullable();
                  $table->string('district_name')->nullable();
                  $table->text('address');
                  $table->integer('zip')->nullable();                                     
                  $table->string('ip_address')->nullable();
                  $table->integer('total_items')->default(1);            
                  $table->integer('amount');            
                  $table->integer('payment_id');            
                  $table->string('payment_method');            
                  $table->string('transaction_id');            
                  $table->string('invoice_no')->nullable();
                  $table->date('delivery_date');            
                  $table->integer('delivery_charge');            
                  $table->tinyInteger('status')->default(1);            
                  $table->tinyInteger('paid')->default(0);            
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
