<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDelivriesTable extends Migration
{
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->decimal('price', 8, 3)->default(0.000);
            $table->longText('content');
            $table->string('image');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
        Schema::table('tenants', function($table) {
            $table->unsignedBigInteger('delivry_id')->nullable()->after('id');
            $table->foreign('delivry_id')->nullable()->on('deliveries')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('tenants', function($table) {
	        $table->dropForeign(['delivry_id']);
            $table->dropColumn('delivry_id');
        });
        Schema::dropIfExists('deliveries');
    }
}
