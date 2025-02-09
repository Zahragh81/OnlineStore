<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    // رابطه چند به چند بیین کالا با کالا(کالای مرتبط)
    public function up(): void
    {
        Schema::create('related_products', function (Blueprint $table) {
            $table->foreignId('product_id')->comment('کد کالا')->constrained();
            $table->foreignId('related_product_id')->comment('کد کالا مرتبط')->constrained('products');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('related_products');
    }
};
