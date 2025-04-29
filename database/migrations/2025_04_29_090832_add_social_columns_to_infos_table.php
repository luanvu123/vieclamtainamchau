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
    Schema::table('infos', function (Blueprint $table) {
        $table->string('whatsapp')->nullable();
        $table->string('wechat')->nullable();
        $table->string('facebook')->nullable();
        $table->string('email')->nullable();
        $table->string('zalo')->nullable();
        $table->string('facebook_candidate')->nullable();
        $table->string('email_candidate')->nullable();
    });
}

public function down()
{
    Schema::table('infos', function (Blueprint $table) {
        $table->dropColumn([
            'whatsapp', 'wechat', 'facebook', 'email',
            'zalo', 'facebook_candidate', 'email_candidate'
        ]);
    });
}

};
