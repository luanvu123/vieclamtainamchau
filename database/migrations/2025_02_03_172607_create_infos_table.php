<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('phone');
            $table->string('gmail');
            $table->string('copyright');
            $table->string('newspaper')->nullable();
            $table->string('footer-company');
            $table->string('url_facebook')->nullable();
            $table->string('url_youtube')->nullable();
            $table->string('url_partner')->nullable();
            $table->integer('number_job_seeker_1')->default(0);
            $table->integer('number_job_seeker_2')->default(0);
            $table->integer('number_employer_1')->default(0);
            $table->integer('number_employer_2')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('infos');
    }
};
