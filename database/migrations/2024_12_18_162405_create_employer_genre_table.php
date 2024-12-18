<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployerGenreTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('employer_genre', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employer_id');
            $table->unsignedBigInteger('genre_id');
            $table->timestamps();

            $table->foreign('employer_id')->references('id')->on('employers')->onDelete('cascade');
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');

            $table->unique(['employer_id', 'genre_id']); // Đảm bảo mỗi cặp employer-genre là duy nhất
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('employer_genre');
    }
}
