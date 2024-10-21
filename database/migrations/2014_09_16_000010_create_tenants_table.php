<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->enum('order_delivery',['Parcel','UBEX','Essco','Semtha'])->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('paid')->default(0);
            $table->json('data')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('domains', function (Blueprint $table) {
            $table->increments('id');
            $table->string('domain', 255)->unique();
            $table->string('tenant_id');
            $table->foreign('tenant_id')->references('id')->on('tenants')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('domains');
        Schema::dropIfExists('tenants');
    }
}
