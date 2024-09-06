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
        Schema::create('setting_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('setting_id')->constrained('settings','id')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('name');
            $table->string('address');
            $table->text('description');
            $table->string('words_guide');
            $table->string('about');
            $table->string('privacy');
            $table->string('terms');
            $table->longText('why_hospital');
            $table->longText('path_to_success');
            $table->longText('sustainability');
            $table->longText('hospital_policies');
            $table->longText('management_team');
          

            $table->unique(['setting_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_translations');
    }
};