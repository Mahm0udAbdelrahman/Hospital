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
        Schema::create('patients_respon_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patients_respon_id')->constrained('patients_respons','id')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('name');     
            $table->longText('description');
            $table->unique(['patients_respon_id', 'locale']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients_respon_translations');
    }
};
