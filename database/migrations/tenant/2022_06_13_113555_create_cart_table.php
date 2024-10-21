<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();

            $table->string('client_id')->nullable();

            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->nullable()->on('products')->references('id')->onUpdate('cascade')->onDelete('cascade');
        
            $table->integer('size_id')->nullable();
            
            $table->integer('color_id')->nullable();
            
            $table->smallInteger('quantity');
            
            $table->text('note')->nullable();
            
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cart');
    }
}
