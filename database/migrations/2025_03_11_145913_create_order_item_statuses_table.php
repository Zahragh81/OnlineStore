<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    //وضعیت ایتم های سفارش
    public function up(): void
    {
        Schema::create('order_item_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('نام');
            $table->boolean('status')->default(true)->comment('وضعیت');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('order_item_statuses');
    }
};
