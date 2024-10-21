<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mobile', function (Blueprint $table) {
            $table->id();
            $table->json('mobile_home')->nullable();
            
            $table->string('cart')->default('1');
            $table->string('notification')->default('1');
            $table->string('products')->default('horizontal');
            $table->string('products_type')->default('animated');
            $table->string('offers')->default('basic');
            $table->string('navbar')->default('categories');
            
            $table->json('tabs_home')->default('1');
            $table->json('tabs_categories')->default('1');
            $table->json('tabs_cart')->default('1');
            $table->json('tabs_profile_page')->default('1');
            $table->json('tabs_notification')->default('1');
            $table->json('tabs_orders')->default('1');
            $table->timestamps();
        });
        DB::table('mobile')->insert([
            'id' => '1', 
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('mobile');
    }
};
