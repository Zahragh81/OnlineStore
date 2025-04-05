<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    // ایتم های سفارش
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->integer('number')->comment('تعداد');
            $table->bigInteger('per_unit')->comment('مبلغ واحد');
            $table->bigInteger('total_amount')->comment('مبلغ کل');

            $table->boolean('status')->default(true)->comment('وضعیت');

            $table->foreignId('order_id')->comment('کد سفارش')->constrained();
            $table->foreignId('product_balance_id')->comment('کد اعلام موجودی')->constrained();
            $table->foreignId('order_item_status_id')->comment('کد وضعیت ایتم های سفارش')->default(1)->constrained();

            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
