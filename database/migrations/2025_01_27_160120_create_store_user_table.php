<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //رابطه یک به چند بین کاربر وفروشگاه
    public function up(): void
    {
        Schema::create('store_user', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(true)->comment('وضعیت');

            $table->foreignId('user_id')->comment('کد کاربر')->constrained();
            $table->foreignId('store_id')->comment('کد فروشگاه')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('store_user');
    }
};
