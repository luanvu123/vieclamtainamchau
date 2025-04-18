<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddServiceTypeToJobPostingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_postings', function (Blueprint $table) {
            // Thêm cột service_type với kiểu dữ liệu string
            $table->string('service_type')->nullable()->after('sex');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_postings', function (Blueprint $table) {
            // Xóa cột service_type khi rollback
            $table->dropColumn('service_type');
        });
    }
}
