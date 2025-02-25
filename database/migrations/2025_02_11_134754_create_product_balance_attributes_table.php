<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    // جدول ویژگیهای اعلام موجودی
    public function up(): void
    {
        Schema::create('product_balance_attributes', function (Blueprint $table) {
            $table->id();
            $table->json('value')->nullable()->comment('مقدار ویژگی (عدد یا مجموعه)');
            $table->boolean('status')->default(true)->comment('وضعیت');

            $table->foreignId('product_balance_id')->comment('کد اعلام موجودی')->constrained();
            $table->foreignId('product_nature_attribute_id')->comment('کد ویژگی ماهیت کالا')->constrained();

            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('product_balance_attributes');
    }
};
