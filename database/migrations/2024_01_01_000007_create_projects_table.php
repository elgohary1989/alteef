<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {

            $table->id();

            // URL
            $table->string('slug')->unique();

            // Titles
            $table->string('title_ar');
            $table->string('title_en');

            // Short Description
            $table->text('summary_ar')->nullable();
            $table->text('summary_en')->nullable();

            // Full Content
            $table->longText('content_ar')->nullable();
            $table->longText('content_en')->nullable();

            // Images
            $table->string('cover_image')->nullable();
            $table->string('thumbnail_image')->nullable();

            // Gallery
            $table->json('gallery')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Modules
            |--------------------------------------------------------------------------
            | سيتم حفظ الموديولات فى صورة JSON
            */
            $table->json('modules')->nullable();

            // Client
            $table->string('client_name')->nullable();

            // Project URL
            $table->string('project_url')->nullable();

            // Type
            $table->string('project_type')->nullable();

            // Technologies
            $table->string('technologies')->nullable();

            // Date
            $table->year('project_year')->nullable();

            // Theme Color
            $table->string('color')->nullable();

            // Sector
            $table->foreignId('sector_id')
                ->nullable()
                ->constrained('sectors')
                ->nullOnDelete();

            // Sorting
            $table->unsignedInteger('order')->default(0);

            // Featured
            $table->boolean('is_featured')->default(false);

            // Status
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // Indexes
            $table->index('slug');
            $table->index('sector_id');
            $table->index('project_year');
            $table->index('is_active');
            $table->index('is_featured');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
