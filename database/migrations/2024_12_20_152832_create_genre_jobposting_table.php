<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenreJobPostingTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('genre_jobposting', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('genre_id');
            $table->unsignedBigInteger('job_posting_id');
            $table->timestamps();

            // Foreign keys
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');
            $table->foreign('job_posting_id')->references('id')->on('job_postings')->onDelete('cascade');

            // Ensure unique pair
            $table->unique(['genre_id', 'job_posting_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genre_jobposting');
    }
}
