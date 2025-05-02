<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHotToGenresTable extends Migration
{
    public function up()
    {
        Schema::table('genres', function (Blueprint $table) {
            $table->boolean('hot')->default(1)->after('status');
        });
    }

    public function down()
    {
        Schema::table('genres', function (Blueprint $table) {
            $table->dropColumn('hot');
        });
    }
}
