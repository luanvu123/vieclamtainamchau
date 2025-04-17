<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_xx_xx_create_advertises_table.php
public function up()
{
    Schema::create('advertises', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('employer_id');
        $table->string('title');
        $table->string('image')->nullable();
        $table->text('content')->nullable();
        $table->boolean('status')->default(true);
        $table->timestamps();

        $table->foreign('employer_id')->references('id')->on('employers')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertises');
    }
};
