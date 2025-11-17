<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // عنوان
            $table->text('short_description'); // توضیحات کوتاه
            $table->json('images')->nullable(); // تصاویر (چند تصویر + انتخاب از کتابخانه)
            $table->string('video_url')->nullable(); // ویدیو از سایت آپارات
            $table->string('meta_title')->nullable(); // عنوان متا
            $table->text('meta_description')->nullable(); // توضیحات متا
            $table->text('keywords')->nullable(); // کلمات کلیدی
            $table->string('slug')->unique(); // اسلاگ
            $table->text('address')->nullable(); // آدرس
            $table->string('phone_number')->nullable(); // شماره تماس
            $table->string('email')->nullable(); // ایمیل
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};