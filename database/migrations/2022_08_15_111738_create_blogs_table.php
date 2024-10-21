<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title_en')->nullable();
            $table->string('title_ar')->nullable();
            $table->text('image')->nullable();
            $table->longText('short_desc_en')->nullable();
            $table->longText('short_desc_ar')->nullable();
            $table->longText('long_desc_en')->nullable();
            $table->longText('long_desc_ar')->nullable();
            $table->longText('blog-trixFields')->nullable();
            $table->longText('attachment-blog-trixFields')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('blogs');
    }
};
