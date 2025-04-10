<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('service_weeks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->enum('number_of_weeks', [1, 2, 4]);
            $table->timestamps();

            $table->unique(['service_id', 'number_of_weeks']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_weeks');
    }
};
