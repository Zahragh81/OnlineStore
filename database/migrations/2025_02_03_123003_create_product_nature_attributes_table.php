<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    //ویژگی های ماهیت کالا
    public function up(): void
    {
        Schema::create('product_nature_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('نام');
            $table->text('description')->nullable()->comment('توضیحات کالا');
            $table->boolean('status')->default(true)->comment('وضعیت');

            $table->foreignId('product_nature_attribute_type_id')->comment('کد نوع ویژگی های ماهیت کالا')->constrained();

            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('product_nature_attributes');
    }
};
