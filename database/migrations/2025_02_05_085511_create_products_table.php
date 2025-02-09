<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    // کالاها
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('نام کالا');
            $table->text('product_introduction')->nullable()->comment('معرفی کالا');
            $table->boolean('status')->default(true)->comment('وضعیت');

            $table->foreignId('product_nature_id')->comment('کد ماهیت کالا')->constrained();
            $table->foreignId('brand_id')->comment('کد برند')->constrained();

            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
