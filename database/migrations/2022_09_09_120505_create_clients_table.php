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
        Schema::create('clients', function (Blueprint $table) {

            $table->id();
            $table->string('name', 255);
            $table->string('unique_id', 255)->unique();
            $table->string('spouse_name', 255);
            $table->string('mother_name', 255);
            $table->string('gender', 100);
            $table->string('contact_number');
            $table->string('address');
            $table->integer('age_years');
            $table->dateTime('date_of_registration');
            $table->dateTime('followup_date');
            $table->boolean('consent_for_contact_back')->default(1);
            $table->boolean('pwd')->default(1);
            $table->jsonb('no_of_children'); //{girl: 1, boy: 3}
            $table->string('type', 100);
            $table->string('current_method', 100)->nullable();
            $table->string('period_months', 100)->nullable();
            $table->string('reason', 255)->nullable();
            $table->string('registered_at', 100); //Client Registered at (HHV, NHM, OM)
            $table->boolean('referred')->default(0);
            $table->integer('added_by'); 
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
        Schema::dropIfExists('clients');
    }
};
