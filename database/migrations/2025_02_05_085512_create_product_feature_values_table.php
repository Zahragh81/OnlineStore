<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    // ویژگی های کالا
    public function up(): void
    {
        Schema::create('product_feature_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->comment('کد کالا')->constrained();
            $table->foreignId('product_nature_attribute_id')->comment('کد ویژگی ماهیت کالا')->constrained();
            $table->json('value')->nullable()->comment('مقدار ویژگی (عدد یا مجموعه)');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('product_feature_values');
    }
};
