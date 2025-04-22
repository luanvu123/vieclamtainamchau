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
    Schema::table('banks', function (Blueprint $table) {
        $table->string('swift_code')->nullable()->after('account_number');
    });
}

public function down()
{
    Schema::table('banks', function (Blueprint $table) {
        $table->dropColumn('swift_code');
    });
}

};
