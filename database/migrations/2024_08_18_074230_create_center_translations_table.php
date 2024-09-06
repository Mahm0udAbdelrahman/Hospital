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
        Schema::create('center_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('center_id')->constrained('centers','id')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('name');     
            $table->longText('description');
            $table->unique(['center_id', 'locale']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('center_translations');
    }
};
