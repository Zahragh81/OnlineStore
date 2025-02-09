<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    //رابطه چند به چند بین ماهیت کالا و ویژگی های ماهیت کالا
    public function up(): void
    {
        Schema::create('product_nature_product_nature_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_nature_id')->comment('کد ماهیت کالا')->constrained();
            $table->foreignId('product_nature_attribute_id')->comment('کدویژگی ماهیت کالا')->constrained();
            $table->boolean('admin_panel')->default(false)->comment('ادمین');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('product_nature_product_nature_attributes');
    }
};
