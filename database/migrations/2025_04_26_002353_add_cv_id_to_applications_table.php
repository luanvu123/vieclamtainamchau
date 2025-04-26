<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->unsignedBigInteger('cv_id')->nullable()->after('job_posting_id');

            // Nếu có bảng `cvs`:
            $table->foreign('cv_id')->references('id')->on('cvs')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropForeign(['cv_id']);
            $table->dropColumn('cv_id');
        });
    }
};
