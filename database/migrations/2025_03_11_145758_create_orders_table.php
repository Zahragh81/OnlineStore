<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    // سفارشات
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('shipping_cost')->comment('هزینه ارسال');
            $table->bigInteger('discount')->comment('تخفیف');
            $table->bigInteger('final_amount_payable')->comment('مبلغ نهایی قابل پرداخت');
            $table->string('first_name')->comment('نام');
            $table->string('last_name')->comment('فامیل');
            $table->string('address')->comment('نشانی1');
            $table->string('address_2')->nullable()->comment('نشانی2');
            $table->string('mobile')->comment('موبایل');
            $table->string('phone')->comment('تلفن ثابت');
            $table->string('postal_code')->nullable()->comment('کد پستی');
            $table->string('shipment_code')->nullable()->comment('کد مرسوله');
            $table->string('shipping_company_name')->nullable()->comment('نام شرکت باربری');
            $table->boolean('pay_status')->default(false)->comment('وضعیت پرداخت');
            $table->boolean('status')->default(true)->comment('وضعیت');

            $table->foreignId('user_id')->comment('کد کاربر')->constrained();
            $table->foreignId('shipping_method_id')->comment('کد روشهای ارسال')->constrained();
            $table->foreignId('province_id')->comment('کد استان')->constrained();
            $table->foreignId('city_id')->comment('کد شهر')->constrained('cities');
            $table->foreignId('order_status_id')->comment('کد وضعیت سفارش')->default(1)->constrained();
            $table->foreignId('payment_gateway_id')->nullable()->comment('کد درگاه پرداخت')->constrained();
            $table->foreignId('courier_id')->comment('کد پیک')->nullable()->constrained();
            $table->foreignId('payment_method_id')->comment('کد روش پرداخت')->constrained();

            $table->dateTime('shipping_time')->nullable()->comment('زمان ارسال');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
