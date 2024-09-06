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
        Schema::create('insurance_section_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('insurance_section_id')->constrained('insurance_sections','id')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('name');            
            $table->unique(['insurance_section_id', 'locale'], 'section_id_locale_unique');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurance_section_translations');
    }
};
