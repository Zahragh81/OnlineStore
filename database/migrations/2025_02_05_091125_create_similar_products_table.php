<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    //رابطه چند به چند کالا با کالا (جدول کالاهای مشابه)
    public function up(): void
    {
        Schema::create('similar_products', function (Blueprint $table) {
            $table->foreignId('product_id')->comment('کد کالا')->constrained();
            $table->foreignId('similar_product_id')->comment('کد کالا مشابه')->constrained('products');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('similar_products');
    }
};
