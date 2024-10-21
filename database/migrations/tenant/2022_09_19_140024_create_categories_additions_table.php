<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesAdditionsTable extends Migration
{
    public function up()
    {
        Schema::create('categories_additions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->on('categories')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('addition_id');
            $table->foreign('addition_id')->on('additions')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories_additions');
    }
}
