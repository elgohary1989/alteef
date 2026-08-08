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
        Schema::table('aboutus', function (Blueprint $table) {
            $table->string('manager_image')->nullable();

            $table->string('manager_name_ar')->nullable();
            $table->string('manager_name_en')->nullable();

            $table->string('manager_position_ar')->nullable();
            $table->string('manager_position_en')->nullable();

            $table->longText('manager_message_ar')->nullable();
            $table->longText('manager_message_en')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('aboutus', function (Blueprint $table) {
            $table->dropColumn([
                'manager_image',
                'manager_name_ar',
                'manager_name_en',
                'manager_position_ar',
                'manager_position_en',
                'manager_message_ar',
                'manager_message_en',
            ]);
        });
    }
};
