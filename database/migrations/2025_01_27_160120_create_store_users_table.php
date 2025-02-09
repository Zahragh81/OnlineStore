<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    //رابطه چند به چند بین کاربر وفروشگاه
    public function up(): void
    {
        Schema::create('store_users', function (Blueprint $table) {
            $table->foreignId('user_id')->comment('کد کاربر')->constrained();
            $table->foreignId('store_id')->comment('کد فروشگاه')->constrained();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('store_user');
    }
};
