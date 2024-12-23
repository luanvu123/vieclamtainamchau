<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employers', function (Blueprint $table) {
            // Primary key
            $table->id(); // id column with auto increment

            // Foreign key to users table
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Employer details
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps(); // created_at and updated_at

            // Additional details
            $table->string('gender')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('status')->default(1); // default 1
            $table->string('avatar')->nullable();
            $table->string('business_license')->nullable();
            $table->string('commission')->nullable();
            $table->string('identification_card')->nullable();
            $table->string('identification_card_behind')->nullable();
            $table->string('company_name')->nullable();
            $table->string('slug')->nullable();
            $table->string('logo')->nullable();

            // OTP and verification status
            $table->string('otp', 6)->nullable();
            $table->boolean('isVerify')->default(0);
            $table->boolean('isVerify_license')->default(0);
            $table->boolean('isVerifyCompany')->default(0);
            $table->boolean('isInfomation')->default(0);
            $table->boolean('IsBasicnews')->default(0);
            $table->boolean('isUrgentrecruitment')->default(0);
            $table->boolean('IsPartner')->default(0);
            $table->boolean('IsRefresheveryhour')->default(0);
            $table->boolean('IsRefresheveryday')->default(0);
            $table->boolean('IsDarkredeffect')->default(0);
            $table->boolean('IsFramingeffect')->default(0);
            $table->boolean('IsHoteffect')->default(0);
            $table->boolean('isVerifyEmail')->default(0);

            // Level and scaling
            $table->integer('level')->nullable();
            $table->string('mst')->nullable();
            $table->string('scale')->nullable();

            // Address and location
            $table->string('address')->nullable();
            $table->longText('map')->nullable();
            $table->string('website')->nullable();

            // Additional description and social media
            $table->text('detail')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employers');
    }
}
