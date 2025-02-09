<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //ماهیت کالا
    public function up(): void
    {
        Schema::create('product_natures', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('status')->comment('وضعیت')->default(true);

            $table->foreignId('store_type_id')->comment('کد نوع فروشگاه')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('product_natures');
    }
};
