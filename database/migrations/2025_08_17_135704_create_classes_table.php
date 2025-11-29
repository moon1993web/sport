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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            
            $table->string('title'); // عنوان کلاس
            
            // 🟩 افزودن اسلاگ برای سئو و آدرس‌دهی
            $table->string('slug')->unique(); 

            // 🟩 افزودن توضیحات (نمیشه کلاس بدون توضیحات باشه!)
            $table->text('description')->nullable();

            $table->string('image')->nullable(); // تصویر

              $table->unsignedBigInteger('price')->nullable(); 
            $table->integer('capacity')->nullable();

            // روابط (Relations) - کدهای خودت عالی بود، فقط کمی مرتب‌تر شد
            $table->foreignId('category_id')
                  ->nullable()
                  ->constrained('categories')
                  ->onDelete('set null'); // اگر دسته‌بندی پاک شد، کلاس بی‌دسته بمونه (حذف نشه)

            $table->foreignId('coach_id')
                  ->constrained('coaches')
                  ->onDelete('cascade'); // اگر مربی پاک شد، کلاس‌هایش هم پاک شود

            // زمان‌بندی (Schedule)
            $table->json('days')->nullable(); // ذخیره روزها: ["Saturday", "Monday"]
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();

            // 🟩 وضعیت (برای مخفی کردن کلاس بدون حذف)
            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};