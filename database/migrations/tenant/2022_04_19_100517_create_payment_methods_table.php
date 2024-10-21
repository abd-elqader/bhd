<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->decimal('vat_local', 8, 3)->default(0.000);
            $table->decimal('vat_global', 8, 3)->default(0.000);
            $table->string('tap_src')->nullable();
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->boolean('status')->default(1);

            $table->timestamps();
        });

        Schema::create('payment_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_id');
            $table->foreign('payment_id')->on('payments')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->string('image')->nullable();
            $table->timestamps();
        });
        
        
        
        \App\Models\Payment::insert(array(
              array('id' => 1,'vat_local' => 0.00,'vat_global' => 0.00,'tap_src' => NULL,'title_ar' => 'كاش','title_en' => 'Cash'),
              array('id' => 2,'vat_local' => 2.95,'vat_global' => 3.50,'tap_src' => 'src_bh.benefit','title_ar' => 'بطاقة الصراف الآلي','title_en' => 'Debit Card'),
              array('id' => 3,'vat_local' => 2.95,'vat_global' => 3.50,'tap_src' => 'src_card','title_ar' => 'بطاقة الإئتمان','title_en' => 'Credit Card'),
              array('id' => 4,'vat_local' => 1.95,'vat_global' => 1.95,'tap_src' => 'src_all','title_ar' => 'بنفت باي','title_en' => 'Benefit Pay'),
              array('id' => 5,'vat_local' => 2.95,'vat_global' => 3.50,'tap_src' => 'src_apple_pay','title_ar' => 'أبل باي','title_en' => 'Apple Pay')
        ));
        
        \App\Models\PaymentImages::insert(array(
            array('payment_id' => '1','image' => '/PaymentMethods/Cash.webp'),
            array('payment_id' => '2','image' => '/PaymentMethods/Debit.webp'),
            array('payment_id' => '3','image' => '/PaymentMethods/Credit.webp'),
            array('payment_id' => '4','image' => '/PaymentMethods/Benefit.webp'),
            array('payment_id' => '5','image' => '/PaymentMethods/TAP.webp')
        ));
    }

    public function down()
    {
        Schema::dropIfExists('payment_images');
        Schema::dropIfExists('payments');
    }
}
