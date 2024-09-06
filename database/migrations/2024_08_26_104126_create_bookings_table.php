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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->nullable()->constrained('doctors','id')->cascadeOnDelete();
            $table->foreignId('doctor_hospital_id')->nullable()->constrained('hospitals','id')->cascadeOnDelete();
            $table->foreignId('doctor_clinic_id')->nullable()->constrained('clinics','id')->cascadeOnDelete();
            $table->string('date');
            $table->foreignId('day_id')->nullable()->constrained('days','id')->cascadeOnDelete();
            $table->string('form');
            $table->string('to'); 
            $table->enum('status',['0','1'])->default(1); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};