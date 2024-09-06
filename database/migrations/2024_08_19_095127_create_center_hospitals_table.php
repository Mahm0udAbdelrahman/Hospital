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
        Schema::create('center_hospitals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('center_id')->constrained('centers','id')->cascadeOnDelete();
            $table->foreignId('hospital_id')->constrained('hospitals','id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('center_hospitals');
    }
};
