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
        Schema::create('medical_technology_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_technology_id')->constrained('medical_technologies','id')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->unique(['medical_technology_id', 'locale'],'medical_id_locale_unique');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_technology_translations');
    }
};
