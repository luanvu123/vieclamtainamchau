<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPostingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_postings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employer_id');
            $table->foreign('employer_id')->references('id')->on('employers')->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->nullable()->index();
            $table->string('type');
            $table->string('age_range')->nullable();
            $table->string('location')->nullable();
            $table->string('tags')->nullable();
            $table->text('description');
            $table->string('application_email_url');
            $table->date('closing_date')->nullable();
            $table->timestamps(); // Includes created_at and updated_at columns
            $table->string('salary')->nullable();
            $table->string('experience')->nullable();
            $table->string('rank')->nullable();
            $table->integer('number_of_recruits')->nullable();
            $table->string('sex')->nullable();
            $table->string('status')->default('1');
            $table->string('skills_required')->nullable();
            $table->string('area')->nullable();
            $table->string('city')->nullable();
            $table->enum('isHot', ['0', '1'])->default('0');
            $table->unsignedBigInteger('views')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_postings');
    }
}
