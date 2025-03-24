<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('weights', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('value', 8, 2); // Định nghĩa cột giá trị cân nặng
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('weights');
    }
};

