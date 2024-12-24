<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('employers', function (Blueprint $table) {
            $table->timestamp('IsBasicnews_updated_at')->nullable();
            $table->timestamp('isUrgentrecruitment_updated_at')->nullable();
            $table->timestamp('IsPartner_updated_at')->nullable();
            $table->timestamp('IsHoteffect_updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('employers', function (Blueprint $table) {
            $table->dropColumn([
                'IsBasicnews_updated_at',
                'isUrgentrecruitment_updated_at',
                'IsPartner_updated_at',
                'IsHoteffect_updated_at'
            ]);
        });
    }
};
