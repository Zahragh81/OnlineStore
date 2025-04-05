<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // روش های ارسال
        Schema::create('shipping_methods', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('عنوان');
            $table->bigInteger('price')->comment('قیمت');
            $table->boolean('status')->default(true)->comment('وضعیت');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('shipping_methods');
    }
};
