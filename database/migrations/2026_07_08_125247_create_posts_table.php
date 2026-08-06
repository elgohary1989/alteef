<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {

            $table->id();

            $table->foreignId('post_category_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('title_ar');
            $table->string('title_en')->nullable();

            $table->string('slug')->unique();

            $table->text('excerpt_ar')->nullable();
            $table->text('excerpt_en')->nullable();

            $table->longText('content_ar');
            $table->longText('content_en')->nullable();

            $table->string('featured_image')->nullable();

            $table->string('source_name_ar')->nullable();
            $table->string('source_name_en')->nullable();
            $table->string('source_url')->nullable();
            $table->unsignedInteger('reading_time')->default(5);

            $table->string('meta_title')->nullable();

            $table->text('meta_description')->nullable();

            $table->json('keywords')->nullable();

            $table->boolean('published')->default(true);

            $table->timestamp('published_at')->nullable();

            $table->unsignedBigInteger('views')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
