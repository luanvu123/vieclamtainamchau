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
    Schema::create('notifications', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('candidate_id');
        $table->string('title');
        $table->text('message');
        $table->string('type'); // application_status, system, etc.
        $table->boolean('is_read')->default(false);
        $table->string('link')->nullable();
        $table->timestamps();

        $table->foreign('candidate_id')->references('id')->on('candidates')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
