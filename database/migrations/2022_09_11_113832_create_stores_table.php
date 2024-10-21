<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->text('desc_ar')->nullable();
            $table->text('desc_en')->nullable();
            $table->boolean('status')->default(1);
            $table->string('website')->nullable();
            $table->string('image')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stores');
    }
};
