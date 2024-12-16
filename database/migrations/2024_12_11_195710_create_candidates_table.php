<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id(); // id
            $table->string('name')->nullable(); // name
            $table->string('email')->unique(); // email
            $table->string('password'); // password
            $table->string('phone')->nullable(); // phone
            $table->date('dob')->nullable(); // dob
            $table->string('avatar_candidate')->nullable(); // avatar_candidate
            $table->string('cv_path')->nullable(); // cv_path
            $table->tinyInteger('status')->default(1); // status
            $table->string('verification_token')->nullable(); // verification_token
            $table->timestamps(); // created_at, updated_at
            $table->string('gender')->nullable(); // gender
            $table->string('address')->nullable(); // address
            $table->string('skill')->nullable(); // skill
            $table->string('position')->nullable(); // position
            $table->tinyInteger('is_public')->default(0); // is_public
            $table->tinyInteger('cv_public')->default(0); // cv_public
            $table->string('linkedin')->nullable(); // linkedin
            $table->text('story')->nullable(); // story
            $table->string('letter_path')->nullable(); // letter_path
            $table->string('google_id')->nullable(); // google_id
            $table->timestamp('email_verified_at')->nullable(); // email_verified_at
            $table->string('level')->nullable(); // level
            $table->string('desired_level')->nullable(); // desired_level
            $table->string('desired_salary')->nullable(); // desired_salary
            $table->string('education_level')->nullable(); // education_level
            $table->integer('years_of_experience')->nullable(); // years_of_experience
            $table->string('working_form')->nullable(); // working_form
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidates');
    }
}
