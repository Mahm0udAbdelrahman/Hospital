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
        Schema::create('medical_tourisms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->enum('type', ['male','female']);
            $table->foreignId('country_id')->constrained('countries','id')->cascadeOnDelete();
            $table->string('date');
            $table->string('medical_report');
            $table->string('case_details');
            $table->enum('status',['0','1'])->default(1); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_tourisms');
    }
};
