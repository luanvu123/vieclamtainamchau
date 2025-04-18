<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeserviceIdToServicesTable extends Migration
{
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->foreignId('typeservice_id')
                  ->nullable()
                  ->constrained('typeservices')
                  ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropForeign(['typeservice_id']);
            $table->dropColumn('typeservice_id');
        });
    }
}
