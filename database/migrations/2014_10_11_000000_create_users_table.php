<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        //کاربران
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable()->comment('کد ملی');
            $table->string('first_name')->nullable()->comment('نام');
            $table->string('last_name')->nullable()->comment('نام خانوادگی');
            $table->string('mobile')->unique()->comment('موبایل');
            $table->string('postal_code')->nullable()->comment('کد پستی');
            $table->boolean('status')->default(true);

            $table->foreignId('gender_id')->nullable()->comment('کد جنسیت')->constrained();
            $table->foreignId('city_id')->nullable()->comment('کد شهر')->constrained();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
