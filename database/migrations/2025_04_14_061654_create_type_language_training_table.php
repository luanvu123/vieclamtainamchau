<?php

// database/migrations/xxxx_xx_xx_create_type_language_training_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeLanguageTrainingTable extends Migration
{
    public function up()
    {
        Schema::create('type_language_training', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('type_language_training');
    }
}
