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
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
                   $table->string('name'); // ستون برای "نام"
            $table->string('title'); // ستون برای "عنوان"
            $table->string('image'); // ستون برای "هکس"
            $table->text('short_description')->nullable(); // ستون برای "توضیحات کوتاه" که می‌تواند خالی باشد
            $table->string('skill_name'); // ستون برای "نام مهارت"
            $table->unsignedTinyInteger('skill_level')->default(0); // ستون برای "میزان تسلط" به صورت عددی (مثلا از 0 تا 100)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
