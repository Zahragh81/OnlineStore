<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   //نشانی ها
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('عنوان');
            $table->string('address')->comment('نشانی');
            $table->string('postal_code')->comment('کد پستی');
            $table->string('latitude')->comment('عرض جغرافیایی');
            $table->string('longitude')->comment('طول جغرافیایی');
            $table->boolean('status')->default(true)->comment('وضعیت');

            $table->foreignId('user_id')->comment('کد به مشتری')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
