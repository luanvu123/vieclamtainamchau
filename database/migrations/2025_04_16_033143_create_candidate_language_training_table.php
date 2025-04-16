<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('candidate_language_training', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained('candidates')->onDelete('cascade');
            $table->foreignId('language_training_id')->constrained('language_training')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();

            // Đặt tên unique index ngắn lại để tránh lỗi
            $table->unique(['candidate_id', 'language_training_id'], 'cand_lang_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidate_language_training');
    }
};
