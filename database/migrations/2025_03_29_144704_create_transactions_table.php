<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id');
            $table->unsignedBigInteger('final_amount_payable');
            $table->boolean('status')->nullable();

            $table->json('invoice_details')->nullable();
            $table->text('transaction_id')->nullable();
            $table->json('transaction_result')->nullable();

            $table->string('authority')->nullable();
            $table->string('reference_id')->nullable();

            $table->foreignId('user_id')->comment('کد کاربر')->constrained();
            $table->foreignId('order_id')->comment('کد سفارش')->constrained();

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
