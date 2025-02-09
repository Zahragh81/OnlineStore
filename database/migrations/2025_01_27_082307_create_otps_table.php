<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('otps', function (Blueprint $table) {
            $table->id();
            $table->string('token')->comment('توکن');
            $table->string('code')->comment('کد');
            $table->boolean('used')->default(false)->comment('وضعیت استفاده
            استفاده نشده = 0
            استفاده شده =  1
            ');

            $table->foreignId('user_id')->comment('کد کاربر')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('otps');
    }
};
