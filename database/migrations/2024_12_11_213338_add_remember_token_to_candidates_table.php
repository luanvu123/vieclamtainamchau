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
        Schema::table('candidates', function (Blueprint $table) {
            $table->rememberToken(); // This will add the remember_token column
        });
    }

    public function down()
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->dropColumn('remember_token');
        });
    }
};