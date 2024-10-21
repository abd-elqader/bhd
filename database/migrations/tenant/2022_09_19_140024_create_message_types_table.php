<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageTypesTable extends Migration
{
    public function up()
    {
        Schema::create('message_types', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('message_types');
    }
}
