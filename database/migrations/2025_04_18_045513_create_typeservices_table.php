<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeservicesTable extends Migration
{
    public function up()
    {
        Schema::create('typeservices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });

        // Add foreign key column to services table
        Schema::table('services', function (Blueprint $table) {
            $table->unsignedBigInteger('typeservice_id')->nullable()->after('id');

            $table->foreign('typeservice_id')->references('id')->on('typeservices')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropForeign(['typeservice_id']);
            $table->dropColumn('typeservice_id');
        });

        Schema::dropIfExists('typeservices');
    }
}
