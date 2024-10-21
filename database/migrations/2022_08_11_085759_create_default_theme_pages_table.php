<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('default_theme_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->string('type')->nullable();
            $table->decimal('order')->nullable();
            $table->timestamps();
        });

        Schema::create('default_theme_pages_components', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('default_theme_page_id');
            $table->unsignedBigInteger('component_id');

            $table->decimal('row_id')->nullable();
            $table->foreign('default_theme_page_id')->references('id')->on('default_theme_pages')->onDelete('cascade');
            $table->foreign('component_id')->references('id')->on('components')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('default_theme_pages_components');
        Schema::dropIfExists('default_theme_pages');
    }
};
