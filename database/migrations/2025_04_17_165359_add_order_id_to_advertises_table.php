<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderIdToAdvertisesTable extends Migration
{
    public function up()
    {
        Schema::table('advertises', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id')->nullable()->after('employer_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('advertises', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropColumn('order_id');
        });
    }
}
