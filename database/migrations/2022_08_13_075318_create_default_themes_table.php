<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('default_themes', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->string('type')->nullable();
            $table->text('image')->nullable();
            $table->timestamps();
        });

        Schema::create('default_theme_pages_default_themes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('default_theme_id');
            $table->unsignedBigInteger('default_theme_page_id');

            $table->foreign('default_theme_id')->references('id')->on('default_themes')->onDelete('cascade');
            $table->foreign('default_theme_page_id')->references('id')->on('default_theme_pages')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('default_theme_pages_default_themes');
        Schema::dropIfExists('default_themes');
    }
};
