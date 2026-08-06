<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_slides', function (Blueprint $table) {

            $table->id();

            // Eyebrow
            $table->string('eyebrow_ar')->nullable();
            $table->string('eyebrow_en')->nullable();

            // Title
            $table->string('title_ar');
            $table->string('title_en');

            // Word Highlight
            $table->string('highlight_word_ar')->nullable();
            $table->string('highlight_word_en')->nullable();

            // Subtitle
            $table->text('subtitle_ar')->nullable();
            $table->text('subtitle_en')->nullable();

            // Primary Button
            $table->string('button_text_ar')->nullable();
            $table->string('button_text_en')->nullable();
            $table->string('button_link')->nullable();

            // Secondary Button
            $table->string('secondary_button_text_ar')->nullable();
            $table->string('secondary_button_text_en')->nullable();
            $table->string('secondary_button_link')->nullable();

            // Media
            $table->string('image')->nullable();

            // Settings
            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_slides');
    }
};
