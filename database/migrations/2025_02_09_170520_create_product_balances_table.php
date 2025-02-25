<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // اعلام موجودی کالا
        Schema::create('product_balances', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('price')->comment('قیمت');
            $table->integer('number')->comment('تعداد');
            $table->boolean('status')->default(true)->comment('وضعیت');

            $table->foreignId('product_id')->comment('کد کالا')->constrained();
            $table->foreignId('store_id')->comment('کد فروشگاه')->constrained();

            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('product_balances');
    }
};
