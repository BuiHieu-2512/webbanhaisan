<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();                             // Khóa chính tự tăng
            $table->string('title');                  // Tiêu đề bài viết
            $table->text('content');                  // Nội dung chi tiết
            $table->string('image')->nullable();      // Đường dẫn ảnh minh họa (nếu có)
            $table->date('publish_date')->nullable(); // Ngày đăng tin
            $table->boolean('is_published')->default(false); // Trạng thái xuất bản
            $table->timestamps();                     // Tự động tạo 2 cột created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
