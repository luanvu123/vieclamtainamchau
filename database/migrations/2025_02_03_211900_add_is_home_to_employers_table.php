<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('employers', function (Blueprint $table) {
            $table->boolean('IsHome')->default(0);
            $table->timestamp('IsHome_updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('employers', function (Blueprint $table) {
            $table->dropColumn(['IsHome', 'IsHome_updated_at']);
        });
    }
};
