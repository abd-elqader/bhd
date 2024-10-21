<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    public function up()
    {
        Schema::create('image_types', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->text('desc_ar')->nullable();
            $table->text('desc_en')->nullable();
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->on('image_types')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        
        \App\Models\ImageType::insert(array(
            array('title_ar' => 'سلايدر','title_en' => 'Slider','status' => '1',),
        ));
    }

    public function down()
    {
        Schema::dropIfExists('images');
        Schema::dropIfExists('image_types');
    }
}
