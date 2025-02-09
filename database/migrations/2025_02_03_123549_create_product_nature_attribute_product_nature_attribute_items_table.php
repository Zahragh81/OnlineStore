<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //رابطه چند به چند بین جدول ایتم ویژگی ماهیت کالا و ویژگی ماهیت کالاها
    public function up(): void
    {
        Schema::create('product_nature_attribute_product_nature_attribute_items', function (Blueprint $table) {
           $table->foreignId('product_nature_attribute_id')->comment('کد ویژگی ماهیت کالا')->constrained();
           $table->foreignId('product_nature_attribute_item_id')->comment('کد ایتم های ویژگی ماهیت کالا')->constrained();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('product_nature_attribute_product_nature_attribute_items');
    }
};
