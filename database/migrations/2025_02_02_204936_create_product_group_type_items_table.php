<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //ایتم گروه محصولات
    public function up(): void
    {
        Schema::create('product_group_type_items', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('نام');
            $table->boolean('status')->default(true)->comment('وضعیت');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('product_group_type_items');
    }
};
