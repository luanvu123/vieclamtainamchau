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
        Schema::create('candidate_study_abroad', function (Blueprint $table) {
    $table->id();
    $table->foreignId('candidate_id')->nullable()->constrained()->onDelete('set null');
    $table->foreignId('study_abroad_id')->constrained()->onDelete('cascade');
    $table->string('name');
    $table->string('phone');
    $table->string('address')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_study_abroad');
    }
};
