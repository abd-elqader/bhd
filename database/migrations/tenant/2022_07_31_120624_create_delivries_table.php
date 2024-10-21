<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDelivriesTable extends Migration
{
    public function up()
    {
        Schema::create('delivries', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar');
            $table->string('title_en');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
        
                
        \App\Models\Tenant\Delivry::insert(array(
            array('id' => '1','title_ar' => 'توصيل إلى المنزل','title_en' => 'Delivery','status' => 1),
            array('id' => '2','title_ar' => 'إستلام من  المحل','title_en' => 'Pick Up','status' =>1),
            array('id' => '3','title_ar' => 'داخل ألمحل','title_en' => 'Dine In','status' => 0)
        ));
    }

    public function down()
    {
        Schema::dropIfExists('delivries');
    }
}
