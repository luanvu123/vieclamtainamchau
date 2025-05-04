<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeySearchAndCompanyPartnerTables extends Migration
{
    public function up(): void
    {
        // Tạo bảng key_search
        Schema::create('key_search', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        // Tạo bảng company_partner
        Schema::create('company_partner', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable(); // lưu tên file ảnh
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_partner');
        Schema::dropIfExists('key_search');
    }
}
