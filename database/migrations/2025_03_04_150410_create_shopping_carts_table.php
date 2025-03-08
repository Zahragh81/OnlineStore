<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // سبد خرید
    public function up(): void
    {
        Schema::create('shopping_carts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('unit_price')->comment('مبلغ واحد');
            $table->integer('number')->comment('تعداد');
            $table->boolean('status')->comment('وضعیت');

            $table->foreignId('user_id')->comment('کد کاربر')->constrained();
            $table->foreignId('product_balance_id')->comment('کد اعلام موجودی')->constrained();

            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('shopping_carts');
    }
};
