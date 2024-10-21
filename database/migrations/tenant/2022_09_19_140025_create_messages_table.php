<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('content')->nullable();

            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id')->nullable()->on('clients')->references('id')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id')->nullable()->on('message_types')->references('id')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('complaint_id')->nullable();
            $table->foreign('complaint_id')->nullable()->on('complaints')->references('id')->onUpdate('cascade')->onDelete('cascade');

            $table->boolean('type')->nullable();
            $table->boolean('is_read')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
