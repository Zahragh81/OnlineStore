<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    //رابطه چند به چند بین فروشگاه و نوع فروشگاه
    public function up(): void
    {
        Schema::create('store_store_types', function (Blueprint $table) {
            $table->foreignId('store_id')->comment('کد فروشگاه')->constrained();
            $table->foreignId('store_type_id')->comment('کد نوع فروشگاه')->constrained();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('store_store_types');
    }
};
