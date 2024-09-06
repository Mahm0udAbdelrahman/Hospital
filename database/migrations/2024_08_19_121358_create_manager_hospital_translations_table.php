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
        Schema::create('manager_hospital_translations', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('manager_hospital_id')->constrained('manager_hospitals','id')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('name');     
            $table->string('position');     
            $table->longText('description');
            $table->unique(['manager_hospital_id', 'locale'] , 'manager_id_locale_unique');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manager_hospital_translations');
    }
};
