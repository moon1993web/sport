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
        Schema::create('coaches', function (Blueprint $table) {
         $table->id();
    $table->string('full_name');
    $table->string('slug')->unique(); 

        $table->string('image')->nullable();
        $table->enum('education', ['diploma', 'bachelor', 'master', 'phd']);
        $table->text('short_description');
        $table->text('bio')->nullable();
        $table->string('phone_number', 15)->unique();
        $table->string('email')->unique();
        $table->string('linkedin_url')->nullable();
        $table->string('instagram_url')->nullable();
        $table->json('specialties')->nullable();

        $table->boolean('is_active')->default(true);
        $table->integer('sort_order')->default(0);
        $table->softDeletes();

        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coaches');
    }
};
