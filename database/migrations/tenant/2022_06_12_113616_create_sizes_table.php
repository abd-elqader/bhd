<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSizesTable extends Migration
{
    public function up()
    {
        Schema::create('sizes', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
        
        \App\Models\Tenant\Size::insert(array(
            array('title_ar' => 'لجميع المقاسات','title_en' => 'All Sizes','status' => '1'),
            array('title_ar' => 'S','title_en' => 'S','status' => '1'),
            array('title_ar' => 'M','title_en' => 'M','status' => '1'),
            array('title_ar' => 'L','title_en' => 'L','status' => '1')
        ));
    }

    public function down()
    {
        Schema::dropIfExists('sizes');
    }
}
