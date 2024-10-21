<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            $table->string('transaction_number')->default(0);
            $table->integer('delivery_company_id')->nullable();
            
            $table->unsignedBigInteger('address_id')->nullable();
            $table->foreign('address_id')->nullable()->on('addresses')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('delivery_id');
            $table->foreign('delivery_id')->on('delivries')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->on('clients')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')->on('branches')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('payment_id');
            $table->foreign('payment_id')->on('payments')->references('id')->onUpdate('cascade')->onDelete('cascade');

            $table->decimal('sub_total', 9, 3)->default(0);
            $table->decimal('OnlineVat', 9, 3)->default(0);
            $table->decimal('discount', 9, 3)->default(0);
            $table->integer('discount_percentage')->default(0);
            $table->decimal('vat', 9, 3)->default(0);
            $table->integer('vat_percentage')->default(0);
            $table->decimal('coupon', 9, 3)->default(0);
            $table->integer('coupon_percentage')->default(0);
            $table->decimal('charge_cost', 9, 3)->default(0);
            $table->decimal('net_total', 9, 3)->default(0);

            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('follow')->default(0);

            $table->tinyInteger('use_points')->default(0);
            $table->tinyInteger('points_number')->default(0);
            $table->tinyInteger('gained_points')->default(0);
            $table->tinyInteger('client_points')->default(0);

            $table->string('mobile_type')->default(0);

            $table->string('store_tracking_link')->nullable();
            $table->string('pickupId')->nullable();
            $table->string('client_tracking_link')->nullable();
            $table->string('deliveryId')->nullable();
            
            $table->string('note')->nullable();
            
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->on('orders')->references('id')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->on('products')->references('id')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('color_id')->nullable();
            $table->foreign('color_id')->nullable()->on('colors')->references('id')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('size_id');
            $table->foreign('size_id')->on('sizes')->references('id')->onUpdate('cascade')->onDelete('cascade');

            $table->decimal('price', 8, 3)->nullable();
            $table->smallInteger('quantity');
            $table->decimal('total', 9, 3)->nullable();
            $table->timestamps();
        });
        Schema::create('order_address', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->on('orders')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('address_id');
            $table->foreign('address_id')->on('addresses')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('order_product_addition', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_product_id');
            $table->foreign('order_product_id')->on('order_product')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('addition_id');
            $table->foreign('addition_id')->on('additions')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('order_product_remove', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_product_id');
            $table->foreign('order_product_id')->on('order_product')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('remove_id');
            $table->foreign('remove_id')->on('removes')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_product_remove');
        Schema::dropIfExists('order_product_addition');
        Schema::dropIfExists('order_address');
        Schema::dropIfExists('order_product');
        Schema::dropIfExists('orders');
    }
}
