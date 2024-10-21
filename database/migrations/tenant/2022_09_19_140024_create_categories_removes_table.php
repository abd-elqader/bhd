<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesRemovesTable extends Migration
{
    public function up()
    {
        Schema::create('categories_removes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->on('categories')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('remove_id');
            $table->foreign('remove_id')->on('removes')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories_removes');
    }
}
