<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('study_abroads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('category_study_abroad', function (Blueprint $table) {
            $table->id();
            $table->foreignId('study_abroad_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
        });

        Schema::create('country_study_abroad', function (Blueprint $table) {
            $table->id();
            $table->foreignId('study_abroad_id')->constrained()->onDelete('cascade');
            $table->foreignId('country_id')->constrained()->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_study_abroad');
        Schema::dropIfExists('country_study_abroad');
        Schema::dropIfExists('study_abroads');
    }
};
