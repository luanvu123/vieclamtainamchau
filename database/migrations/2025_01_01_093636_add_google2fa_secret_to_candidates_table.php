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
        $table->string('google2fa_secret')->nullable()->after('verification_token');
    });
}

public function down()
{
    Schema::table('candidates', function (Blueprint $table) {
        $table->dropColumn('google2fa_secret');
    });
}

};
