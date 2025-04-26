<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificatesTable extends Migration
{
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('issuing_organization')->nullable();
            $table->date('issue_date')->nullable();
            $table->date('expiration_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('certificates');
    }
}
