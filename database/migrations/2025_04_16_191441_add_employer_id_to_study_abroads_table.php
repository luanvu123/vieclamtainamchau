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
    Schema::table('study_abroads', function (Blueprint $table) {
        $table->unsignedBigInteger('employer_id')->nullable()->after('id');
        $table->foreign('employer_id')->references('id')->on('employers')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('study_abroads', function (Blueprint $table) {
        $table->dropForeign(['employer_id']);
        $table->dropColumn('employer_id');
    });
}

};
