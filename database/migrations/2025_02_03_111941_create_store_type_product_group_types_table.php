<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    //رابطه چند به چند بین نوع فروشگاه و انواع گروه کالا
    public function up(): void
    {
        Schema::create('store_type_product_group_types', function (Blueprint $table) {
            $table->foreignId('store_type_id')->comment('کد نوع فروشگاه')->constrained();
            $table->foreignId('product_group_type_id')->comment('کد انواع گروه کالا')->constrained();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('store_type_product_group_types');
    }
};
