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
        Schema::create('info_health_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('info_health_id')->constrained('info_healths','id')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('name');     
            $table->longText('description');
            $table->unique(['info_health_id', 'locale']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_health_translations');
    }
};
