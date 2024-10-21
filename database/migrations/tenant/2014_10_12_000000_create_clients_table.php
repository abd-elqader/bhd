<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('lang')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->string('country_code')->nullable();
            $table->string('phone_code')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('theme')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->on('clients')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('region_id')->nullable();
            $table->foreign('region_id')->nullable()->on('regions')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->nullable()->on('cities')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('block_id')->nullable();
            $table->foreign('block_id')->nullable()->on('blocks')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->string('block', 100)->nullable();
            $table->string('road', 100)->nullable();
            $table->string('building_no', 100)->nullable();
            $table->string('floor_no', 100)->nullable();
            $table->string('apartment', 100)->nullable();
            $table->string('type', 100)->nullable();
            $table->text('additional_directions')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('clients');
    }
}
