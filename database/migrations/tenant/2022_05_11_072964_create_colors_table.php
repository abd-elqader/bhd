<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColorsTable extends Migration
{
    public function up()
    {
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->string('hexa')->nullable();
            $table->boolean('status')->default(1);

            $table->timestamps();
        });
        
        
        \App\Models\Tenant\Color::insert(array(
            array('title_ar' => 'أحمر','title_en' => 'Red','hexa' => '#ff0000','status' => '1'),
            array('title_ar' => 'أصفر','title_en' => 'Yellow','hexa' => '#fbe80e','status' => '1'),
            array('title_ar' => 'أخضر','title_en' => 'Green','hexa' => '#40f000','status' => '1'),
            array('title_ar' => 'أزرق','title_en' => 'Blue','hexa' => '#2206b2','status' => '1'),
            array('title_ar' => 'نيلى','title_en' => 'Indigo','hexa' => '#4B0082','status' => '1'),
            array('title_ar' => 'بنفسجى','title_en' => 'Violet','hexa' => '#8F00FF','status' => '1'),
            array('title_ar' => 'الزيتي','title_en' => 'Dark green','hexa' => '#013220 ','status' => '1'),
            array('title_ar' => 'أسود','title_en' => 'Black','hexa' => '#000','status' => '1'),
            array('title_ar' => 'أبيض','title_en' => 'White','hexa' => '#ffffff','status' => '1'),
            array('title_ar' => 'سماوي','title_en' => 'Light blue','hexa' => '#ADD8E6','status' => '1'),
            array('title_ar' => 'وردي','title_en' => 'Pink','hexa' => '#FFC0CB ','status' => '1'),
            array('title_ar' => 'ماروني','title_en' => 'Maroon','hexa' => '#800000','status' => '1'),
            array('title_ar' => 'بيج','title_en' => 'Node','hexa' => '#215732','status' => '1'),
            array('title_ar' => 'بني','title_en' => 'Brown','hexa' => '#964B00','status' => '1')
        ));
    }

    public function down()
    {
        Schema::dropIfExists('colors');
    }
}
