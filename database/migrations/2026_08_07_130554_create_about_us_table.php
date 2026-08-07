<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | About Us
        |--------------------------------------------------------------------------
        */

        Schema::create('aboutus', function (Blueprint $table) {

            $table->id();

            /*
            | Hero
            */
            $table->string('hero_title_ar')->nullable();
            $table->string('hero_title_en')->nullable();

            $table->longText('hero_description_ar')->nullable();
            $table->longText('hero_description_en')->nullable();

            $table->string('hero_image')->nullable();

            /*
            | About Section
            */
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();

            $table->longText('description_ar')->nullable();
            $table->longText('description_en')->nullable();

            $table->string('image')->nullable();

            /*
            | Vision
            */
            $table->string('vision_title_ar')->nullable();
            $table->string('vision_title_en')->nullable();

            $table->longText('vision_ar')->nullable();
            $table->longText('vision_en')->nullable();

            /*
            | Mission
            */
            $table->string('mission_title_ar')->nullable();
            $table->string('mission_title_en')->nullable();

            $table->longText('mission_ar')->nullable();
            $table->longText('mission_en')->nullable();

            /*
            | Statistics
            */
            $table->integer('years_experience')->default(0);
            $table->integer('projects_count')->default(0);
            $table->integer('clients_count')->default(0);

            /*
            | CTA
            */
            $table->string('cta_title_ar')->nullable();
            $table->string('cta_title_en')->nullable();

            $table->longText('cta_description_ar')->nullable();
            $table->longText('cta_description_en')->nullable();

            $table->string('cta_button_text_ar')->nullable();
            $table->string('cta_button_text_en')->nullable();

            $table->string('cta_button_link')->nullable();

            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | Why Choose Us
        |--------------------------------------------------------------------------
        */

        Schema::create('about_features', function (Blueprint $table) {

            $table->id();

            $table->foreignId('about_us_id')
                ->constrained('aboutus')
                ->cascadeOnDelete();

            $table->string('title_ar');
            $table->string('title_en');

            $table->longText('description_ar')->nullable();
            $table->longText('description_en')->nullable();

            $table->string('icon')->nullable();

            $table->integer('sort_order')->default(0);

            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | Core Values
        |--------------------------------------------------------------------------
        */

        Schema::create('about_values', function (Blueprint $table) {

            $table->id();

            $table->foreignId('about_us_id')
                ->constrained('aboutus')
                ->cascadeOnDelete();

            $table->string('title_ar');
            $table->string('title_en');

            $table->string('icon')->nullable();

            $table->integer('sort_order')->default(0);

            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | Timeline
        |--------------------------------------------------------------------------
        */

        Schema::create('about_timelines', function (Blueprint $table) {

            $table->id();

            $table->foreignId('about_us_id')
                ->constrained('aboutus')
                ->cascadeOnDelete();

            $table->string('year');

            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();

            $table->longText('description_ar')->nullable();
            $table->longText('description_en')->nullable();

            $table->integer('sort_order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_timelines');
        Schema::dropIfExists('about_values');
        Schema::dropIfExists('about_features');
        Schema::dropIfExists('aboutus');
    }
};
