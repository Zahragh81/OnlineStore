<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    //رابطه چند به چند بین کالا ها و ویژگی کالا ها
    public function up(): void
    {
        Schema::create('product_feature_value_products', function (Blueprint $table) {
            $table->foreignId('product_id')->comment('کد کالا')->constrained();
            $table->foreignId('product_feature_value_id')->comment('کد ویژگی کالا')->constrained();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('product_feature_value_product');
    }
};
