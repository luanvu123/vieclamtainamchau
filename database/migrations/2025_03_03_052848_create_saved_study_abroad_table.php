<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('saved_study_abroad', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_id');
            $table->unsignedBigInteger('study_abroad_id');
            $table->timestamps();

            $table->foreign('candidate_id')->references('id')->on('candidates')->onDelete('cascade');
$table->foreign('study_abroad_id')->references('id')->on('study_abroads')->onDelete('cascade');

            $table->unique(['candidate_id', 'study_abroad_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('saved_study_abroad');
    }
};
