<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    //رابطه چند به چند بین ایتم گروه محصولات و گروه محصولات
    public function up(): void
    {
        Schema::create('product_group_type_product_group_type_items', function (Blueprint $table) {
            $table->foreignId('product_group_type_id')->comment('کد نوع گروه محصول')->constrained();
            $table->foreignId('product_group_type_item_id')->comment('کد ایتم نوع گروه محصول')->constrained();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('product_group_type_product_group_type_items');
    }
};
