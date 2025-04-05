<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
// پیک ها
    public function up(): void
    {
        Schema::create('couriers', function (Blueprint $table) {
            $table->id();
            $table->string('plate_number')->comment('شماره پلاک');
            $table->string('vehicle_name')->comment('نام خودرو');
            $table->boolean('status')->default(true)->comment('وضعیت');

            $table->foreignId('user_id')->comment('کد کاربر')->constrained();
            $table->foreignId('courier_type_id')->comment('کد نوع پیک')->constrained();

            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('couriers');
    }
};
