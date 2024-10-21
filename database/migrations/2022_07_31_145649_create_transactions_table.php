<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->on('clients')->references('id')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id')->on('packages')->references('id')->onUpdate('cascade')->onDelete('cascade');

            $table->string('transaction_number')->nullable();
            $table->decimal('value', 9, 3);
            $table->string('result')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
