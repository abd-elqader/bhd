<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('package_users', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->on('clients')->references('id')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id')->on('packages')->references('id')->onUpdate('cascade')->onDelete('cascade');
            
            $table->timestamp('start_date')->useCurrent();
            $table->timestamp('end_date')->useCurrent();
            
            $table->boolean('paid')->default(0);
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('package_users');
    }
};
