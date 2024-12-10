

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
          
            $table->date('date')->nullable();
            $table->string('phone')->nullable();
            $table->string('language')->nullable();
            $table->string('google')->nullable();
            $table->string('skype')->nullable();
            $table->string('slack')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('paypal')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'address',
                'favorite_color',
                'date',
                'phone',
                'language',
                'google',
                'skype',
                'slack',
                'instagram',
                'facebook',
                'paypal'
            ]);
        });
    }
};
