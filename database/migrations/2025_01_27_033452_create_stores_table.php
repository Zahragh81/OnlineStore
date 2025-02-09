<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        //فروشگاه ها
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('عنوان');
            $table->text('address')->comment('نشانی');
            $table->string('postal_code')->nullable()->comment('کد پستی');
            $table->string('latitude')->nullable()->comment('عرض جغرافیایی');
            $table->string('longitude')->nullable()->comment('طول جغرافیایی');
            $table->string('mobile')->comment('موبایل');
            $table->string('phone')->comment('تلفن');
            $table->string('owner')->comment('مالک');
            $table->boolean('status')->default(true)->comment('وضعیت');

            $table->foreignId('city_id')->comment('کد شهر')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
