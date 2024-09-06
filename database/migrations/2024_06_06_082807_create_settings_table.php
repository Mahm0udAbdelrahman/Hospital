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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('language');
            $table->string('logo')->default('logo.png');
            $table->string('favicon')->default('favicon.png');
            $table->string('phone');
            $table->string('location');
            $table->string('email');
            $table->string('whatsapp');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('instagram');
            $table->string('youtube');
            $table->string('linkedin');
            $table->string('video');
            $table->string('number_of_consultants');
            $table->string('number_of_medical_team');
            $table->string('number_of_beds');
            $table->string('number_of_patients');
            $table->string('sustainability_report')->nullable();
            $table->string('whistleblowing_policy')->nullable();
            $table->string('internal_rules_of_conduct')->nullable();
            $table->string('supplier_code_of_conduct')->nullable();
               
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
