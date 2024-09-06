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
        Schema::create('add_insurances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('insurance_id')->constrained('insurances','id')->cascadeOnDelete()->nullable();
            $table->string('birthday')->nullable();
            $table->string('insurance_card_number')->nullable();
            $table->string('insurance_expiry_date')->nullable();
            $table->string('image')->nullable();
            $table->enum('status',['0','1'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_insurances');
    }
};