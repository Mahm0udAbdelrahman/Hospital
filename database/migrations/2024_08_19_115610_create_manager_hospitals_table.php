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
        Schema::create('manager_hospitals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hospital_id')->constrained('hospitals','id')->cascadeOnDelete();
            $table->string('image')->default('default.png');                     
            $table->enum('position_type',['executive_management','board_of_directors']); 
            $table->enum('status',['0','1'])->default(1); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manager_hospitals');
    }
};
