<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    // درگاه های پرداخت
    public function up(): void
    {
        Schema::create('payment_gateways', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('عنوان');
            $table->string('merchant_id');
            $table->string('terminal_id');
            $table->string('secret_key');
            $table->boolean('status')->default(true)->comment('وضعیت');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('payment_gateways');
    }
};
