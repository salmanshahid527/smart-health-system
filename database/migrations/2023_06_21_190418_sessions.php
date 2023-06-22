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
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->string('fp_champion_name', 255);
            $table->string('district', 255)->nullable();
            $table->string('uc_name', 255)->nullable();
            $table->string('reporting_month', 255)->nullable();
            $table->string('name_of_participant', 255)->nullable();
            $table->string('pwd', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('session_theme', 255)->nullable();
            $table->string('meeting_type', 255)->nullable();
            $table->string('client_reffered', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
