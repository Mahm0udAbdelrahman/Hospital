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
        Schema::create('patients_right_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patients_right_id')->constrained('patients_rights','id')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('name');     
            $table->longText('description');
            $table->unique(['patients_right_id', 'locale']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients_right_translations');
    }
};
