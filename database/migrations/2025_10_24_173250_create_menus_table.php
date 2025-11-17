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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // نام منو
            $table->string('type')->default('main_menu'); // نوع منو (مثلاً main_menu, footer_menu)
            $table->string('link')->default('#'); // لینک منو
            $table->unsignedInteger('position')->default(0); // موقعیت برای مرتب‌سازی
            $table->foreignId('parent_id')->nullable()->constrained('menus')->onDelete('cascade'); // منوی والد
            $table->boolean('status')->default(true); // وضعیت (فعال/غیرفعال)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
