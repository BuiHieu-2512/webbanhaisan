<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(); // Cho phép null
            $table->string('image');
            $table->text('description')->nullable();
            $table->boolean('status')->default(1); // 1: Hiển thị, 0: Ẩn
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('banners');
    }
};
