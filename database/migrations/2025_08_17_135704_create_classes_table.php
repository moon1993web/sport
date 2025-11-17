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
            
            // مرتبط با فیلد "عنوان کلاس"
            $table->string('title');

            // مرتبط با فیلد "عکس"
            $table->string('image')->nullable();

            // کلید خارجی برای "دسته‌بندی کلاس‌ها"
                 $table->foreignId('category_id')->nullable()->constrained('categories') ->onDelete('set null');
                 

                  $table->foreignId('coach_id')->constrained('coaches')->onDelete('cascade');
                 
                

            // مرتبط با چک‌باکس‌های "روزهای کلاس" - به صورت JSON ذخیره می‌شود
            $table->json('days')->nullable();

        
            
            // // برای زمان شروع و پایان که فقط در حالت "custom" مقدار دارند
            // $table->time('start_time')->nullable();
            // $table->time('end_time')->nullable();
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
