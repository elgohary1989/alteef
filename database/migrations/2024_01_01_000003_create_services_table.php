<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {

            $table->id();

            // التصنيف
            $table->foreignId('service_category_id')
                ->constrained('service_categories')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('slug')->unique();

            /*
            |--------------------------------------------------------------------------
            | Basic Info
            |--------------------------------------------------------------------------
            */

            $table->string('title_ar');
            $table->string('title_en');

            $table->text('summary_ar')->nullable();
            $table->text('summary_en')->nullable();

            $table->longText('content_ar')->nullable();
            $table->longText('content_en')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Hero Section
            |--------------------------------------------------------------------------
            */

            $table->string('hero_title_ar')->nullable();
            $table->string('hero_title_en')->nullable();

            $table->text('hero_desc_ar')->nullable();
            $table->text('hero_desc_en')->nullable();

            $table->string('hero_image')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Features
            |--------------------------------------------------------------------------
            */

            $table->json('features_ar')->nullable();
            $table->json('features_en')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Benefits
            |--------------------------------------------------------------------------
            */

            $table->json('benefits_ar')->nullable();
            $table->json('benefits_en')->nullable();

            /*
            |--------------------------------------------------------------------------
            | FAQ
            |--------------------------------------------------------------------------
            */

            $table->json('faqs_ar')->nullable();
            $table->json('faqs_en')->nullable();

            /*
            |--------------------------------------------------------------------------
            | CTA
            |--------------------------------------------------------------------------
            */

            $table->string('cta_text_ar')->nullable();
            $table->string('cta_text_en')->nullable();

            $table->string('cta_link')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Media
            |--------------------------------------------------------------------------
            */

            $table->string('icon')->nullable();

            $table->string('image')->nullable();

            // Gallery Images
            $table->json('gallery')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Settings
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('order')->default(0);

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name_ar');
            $table->string('name_en');

            $table->string('slug')->unique();

            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();

            $table->string('featured_image')->nullable();

            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('image');

            $table->integer('sort_order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_images');
    }
};
