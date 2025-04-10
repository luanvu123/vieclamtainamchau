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
    Schema::create('carts', function (Blueprint $table) {
        $table->id();

        $table->unsignedBigInteger('employer_id');
        $table->foreign('employer_id')->references('id')->on('employers')->onDelete('cascade');

        $table->unsignedBigInteger('service_id');
        $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');

        $table->integer('quantity')->default(1);

        $table->enum('number_of_weeks', [1, 2, 4])->default(1);

        $table->decimal('total_price', 12, 2)->default(0);

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
