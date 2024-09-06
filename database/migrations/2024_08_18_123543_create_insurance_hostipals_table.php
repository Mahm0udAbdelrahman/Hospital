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
        Schema::create('insurance_hostipals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hospital_id')->constrained('hospitals','id')->cascadeOnDelete();
            $table->foreignId('insurance_id')->constrained('insurances','id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurance_hostipals');
    }
};
