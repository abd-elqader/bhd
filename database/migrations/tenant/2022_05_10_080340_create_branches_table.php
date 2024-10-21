<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade')->onUpdate('cascade');

            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();

            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();

            $table->text('address_ar')->nullable();
            $table->text('address_en')->nullable();

            $table->text('working_time_ar')->nullable();
            $table->text('working_time_en')->nullable();

            // New columns
            $table->string('block')->nullable()->default(null);
            $table->string('road')->nullable()->default(null);
            $table->string('building_no')->nullable()->default(null);
            $table->string('floor_no')->nullable()->default(null);
            $table->string('apartment')->nullable()->default(null);

            $table->boolean('status')->default(1);
            $table->string('lat')->nullable();
            $table->string('long')->nullable();

            $table->text('ubex_area')->nullable()->default('16083817-2b2a-44d1-9e37-80cf7b9d4b39');

            $table->timestamps();
        });
        \DB::insert("
            INSERT INTO `branches` (`id`, `country_id`, `title_ar`, `title_en`, `phone`, `whatsapp`, `email`, `address_ar`, `address_en`, `working_time_ar`, `working_time_en`, `status`, `lat`, `long`, `created_at`, `updated_at`) VALUES
            (1, 1, 'فرع البحرين', 'Bahrain	Branch', '+97317300787', '+97317300787', 'AbaAltaibbahrain@gmail.com', 'المنامة', 'Manama', 'من 8 صباحا الى 12 مساءا جميع ايام الاسبوع', 'from 8 AM To 12 All days A Week', 1, '26.221669056721712', '50.58856480756184', '2022-10-09 13:52:16', '2022-12-07 19:58:53'),
            (2, 2, 'الرياض', 'Riyadh', '01012000', '+97333405497', 'test@gmail.com', 'الرياض', 'Riyadh', 'من 7 صباحا الى 10 مساءا جميع ايام الاسبوع', 'from 7 AM To 10 PM All days A Week', 0, '26.227934462972144', '50.58910840410498', '2022-12-05 12:56:56', '2022-12-05 12:56:56');
        ");
        
        Schema::create('branch_worktime', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->on('branches')->references('id')->onUpdate('cascade')->onDelete('cascade');

            $table->time('open')->nullable();
            $table->time('close')->nullable();

            $table->timestamps();
        });
        
        \DB::insert("
            INSERT INTO `branch_worktime` (`id`, `branch_id`, `open`, `close`, `created_at`, `updated_at`) VALUES
            (24, 2, '00:00:00', '23:59:00', '2022-12-15 10:46:40', '2022-12-15 10:46:40'),
            (25, 1, '08:00:00', '23:59:00', '2022-12-15 10:47:22', '2022-12-15 10:47:22');
        ");
    }

    public function down()
    {
        Schema::dropIfExists('branch_worktime');
        Schema::dropIfExists('branches');
    }
}
