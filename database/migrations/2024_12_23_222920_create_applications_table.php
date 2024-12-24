<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::create('applications', function (Blueprint $table) {
        $table->id();
        $table->foreignId('candidate_id')->constrained('candidates')->onDelete('cascade');
        $table->foreignId('job_posting_id')->constrained('job_postings')->onDelete('cascade');
        $table->string('cv_path')->nullable();
        $table->text('introduction')->nullable();
        $table->enum('status', ['pending', 'reviewed', 'accepted', 'rejected'])->default('pending');
        $table->timestamps();
        // Prevent duplicate applications
        $table->unique(['candidate_id', 'job_posting_id']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
