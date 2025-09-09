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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('logo');
            $table->string('about_us_headline')->nullable();
            $table->string('about_us_image')->nullable();
            $table->text('about_us_description')->nullable();
            $table->text('contact_us_description')->nullable();
            $table->string('phone_no');
            $table->string('email');
            $table->text('address');
            $table->text('google_map_link')->nullable();
            $table->string('googleplus_address')->nullable();
            $table->string('facebook_address')->nullable();
            $table->string('instagram_address')->nullable();            
            $table->string('twitter_address')->nullable();            
            $table->string('pinterest_address')->nullable();            
            $table->string('whatsapp_address')->nullable();            
            $table->text('terms_conditions');            
            $table->text('privacy_policy');            
            $table->text('delivery_information');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
