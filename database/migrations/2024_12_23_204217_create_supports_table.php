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
    Schema::create('supports', function (Blueprint $table) {
        $table->id();
        $table->string('phone');
        $table->string('email');
        $table->string('type_title');
        $table->text('description_info');
        $table->enum('status', ['pending', 'completed'])->default('pending');
        $table->timestamps();
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supports');
    }
};
