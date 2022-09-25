<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_referrals', function (Blueprint $table) {
            $table->id();
            $table->dateTime('referral_date');
            $table->string('current_method', 100);
            $table->string('referrar_method', 100);
            $table->integer('service_provder');
            $table->dateTime('visit_date');
            $table->string('adopted_method', 100);
            $table->jsonb('meta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_referrals');
    }
};
