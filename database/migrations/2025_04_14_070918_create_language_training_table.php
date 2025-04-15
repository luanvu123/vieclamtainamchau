<?php

// database/migrations/xxxx_xx_xx_create_language_training_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguageTrainingTable extends Migration
{
    public function up()
    {
        Schema::create('language_training', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_language_training_id')->constrained('type_language_training')->onDelete('cascade');
            $table->foreignId('employer_id')->nullable()->constrained('employers')->onDelete('set null');
            $table->string('slug')->unique();
            $table->string('name');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('status')->default(true);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('language_training');
    }
}
