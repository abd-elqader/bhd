<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->nullable();
            $table->text('value')->nullable();
            $table->string('type')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
        
        \DB::insert("
            INSERT INTO `settings` ( `key`, `value`, `type`) VALUES
            
            ( 'logo', '', 'publicSettings'),
            ( 'theme', 'default-1', 'theme'),
            ( 'color', '#8ac6c2', 'publicSettings'),
            
            ( 'about_ar', 'أهلا بكم في متجر', 'about'),
            ( 'about_en', 'Welcome to Matjr', 'about'),
            ( 'about_image', '', 'about'),
            
            ( 'privacy_ar', 'أهلا بكم في متجر', 'privacy'),
            ( 'privacy_en', 'Welcome to Matjr', 'privacy'),
            ( 'privacy_image', '', 'privacy'),
            
            ( 'terms_ar', 'أهلا بكم في متجر', 'terms'),
            ( 'terms_en', 'Welcome to Matjr', 'terms'),
            ( 'terms_image', '', 'terms'),
            
            ( 'email', 'apps@emcan-group.com', 'publicSettings'),
            ( 'apple', 'https://apps.apple.com/eg/app/matjr/id6444834539', 'publicSettings'),
            ( 'android', 'https://play.google.com/store/apps/details?id=com.emcan.matjar', 'publicSettings'),
            ( 'facebook', 'https://www.facebook.com', 'publicSettings'),
            ( 'instagram', 'https://www.instagram.com', 'publicSettings'),
            ( 'twitter', 'https://www.twitter.com', 'publicSettings'),
            ( 'snapchat', 'https://www.snapchat.com', 'publicSettings'),
            
            ( 'desc', 'Matjr', 'publicSettings'),
            ( 'keywords', 'Matjr' , 'publicSettings'),
            ( 'author', 'Matjr', 'publicSettings'),
            
            
            ( 'mobile', '', 'publicSettings'),
            ( 'phone', '', 'publicSettings'),
            ( 'whatsapp', '', 'publicSettings'),
            ( 'VAT', '10', 'publicSettings'),
            ( 'accept_order', '1', 'publicSettings'),
            
            ( 'order_whatsapp_text_ar', 'Thank You For Ordering From Matjr Your order is under processing, it will be delivered within 55 minutes', 'publicSettings'),
            ( 'order_whatsapp_text_en', 'شكرًا لك على الطلب من Matjr  طلبك قيد المعالجة ، وسيتم توصيله في غضون 55 دقيقة', 'publicSettings'),
            
            ( 'DefaultLang', 'ar', 'publicSettings'),
            ( 'OnlineVat', '1', 'publicSettings'),
            ( 'DefaultCurrancy', '1', 'publicSettings');
        ");
        \DB::insert("
            INSERT INTO `settings` (`key`, `value`, `type`) VALUES
                ('snapchat_services', '', 'advertising'),
                ('twitter_services', '', 'advertising'),
                ('facebbok_services', '', 'advertising'),
                ('google_services', '', 'advertising'),
                ('tiktok_services', '', 'advertising'),
                ('instagram_services', '', 'advertising');
        ");
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
