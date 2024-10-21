<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->decimal('price', 8, 3)->default(0.000);
            $table->string('price_ar')->nullable();
            $table->string('price_en')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('days')->default(30);
            $table->timestamps();
        });
        Schema::create('package_descs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id')->on('packages')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->timestamps();
        });

        Schema::create('feature_headers', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->timestamps();
        });
        Schema::create('features', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->string('image')->nullable();
            $table->enum('type', ['icon', 'text']);
            $table->unsignedBigInteger('header_id');
            $table->foreign('header_id')->on('feature_headers')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
        Schema::create('feature_package', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id')->on('packages')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('feature_id');
            $table->foreign('feature_id')->on('features')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('feature_package');
        Schema::dropIfExists('features');
        Schema::dropIfExists('feature_headers');

        Schema::dropIfExists('package_descs');
        Schema::dropIfExists('packages');
    }
}
