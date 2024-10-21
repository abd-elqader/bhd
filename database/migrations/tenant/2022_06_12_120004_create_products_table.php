<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->text('desc_ar')->nullable();
            $table->text('desc_en')->nullable();
            $table->enum('VAT', ['inclusive', 'exclusive']);
            $table->boolean('status')->default(1);
            $table->boolean('most_selling')->default(0);
            $table->boolean('popular')->default(1);

            $table->float('weight');
            $table->boolean('has_color');
            $table->boolean('has_size');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->on('categories')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->on('products')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('product_size_color', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->on('products')->references('id')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('size_id')->nullable();
            $table->foreign('size_id')->nullable()->on('sizes')->references('id')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('color_id')->nullable();
            $table->foreign('color_id')->nullable()->on('colors')->references('id')->onUpdate('cascade')->onDelete('cascade');

            $table->decimal('price', 8, 3)->default(0.000);
            
            $table->integer('quantity')->default(0);
            
            $table->boolean('status')->default(1);

            $table->decimal('discount', 8, 3)->nullable()->default(0);
            $table->date('from')->nullable();
            $table->date('to')->nullable();

            $table->timestamps();
        });

        Schema::create('product_favourites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->on('clients')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->on('products')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->boolean('status')->default(1);

            $table->unsignedBigInteger('color_id')->nullable();
            $table->foreign('color_id')->nullable()->on('colors')->references('id')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->on('products')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->on('clients')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->on('products')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->float('rate');
            $table->string('comment')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('product_favourites');
        Schema::dropIfExists('product_reviews');
        Schema::dropIfExists('product_size_color');
        Schema::dropIfExists('product_categories');
        Schema::dropIfExists('products');
    }
}
