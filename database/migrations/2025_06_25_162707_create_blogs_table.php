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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('title');
            $table->date('date');
            $table->string('author')->nullable();
            $table->text('short_description');
            $table->longText('content')->nullable();
            $table->string('tags')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();

            // 2. محدودیت کلید خارجی را تعریف می‌کنیم
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
                
               // اگر یک دسته بندی حذف شد، مقدار این فیلد در بلاگ‌های مرتبط null می‌شود
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::dropIfExists('blogs');
    }
 
};
