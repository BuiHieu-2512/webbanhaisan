<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('fullname'); // Họ tên
            $table->string('phone')->nullable(); // Số điện thoại (có thể nullable)
            $table->string('email')->nullable(); // Email (nullable nếu không bắt buộc)
            $table->text('message');  // Nội dung liên hệ
            $table->timestamps();     // Tự động tạo cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};
