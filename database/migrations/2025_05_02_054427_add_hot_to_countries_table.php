<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHotToCountriesTable extends Migration
{
    public function up()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->boolean('hot')->default(1)->after('status');
        });
    }

    public function down()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('hot');
        });
    }
}
