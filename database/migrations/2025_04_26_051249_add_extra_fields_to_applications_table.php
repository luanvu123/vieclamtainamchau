<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraFieldsToApplicationsTable extends Migration
{
    public function up()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->string('cv_path_hidden_info')->nullable()->after('cv_path');
            $table->enum('approve_application', ['Chờ duyệt', 'Đã duyệt', 'Nộp lại', 'Từ chối'])->default('Chờ duyệt')->after('status');
            $table->string('cv_path_resubmit')->nullable()->after('approve_application');
        });
    }

    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn(['cv_path_hidden_info', 'approve_application', 'cv_path_resubmit']);
        });
    }
}
