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
            $table->jsonb('contact_numbers');
            $table->jsonb('addresses');
            $table->dateTime('date_of_birth');
            $table->dateTime('date_of_registration');
            $table->dateTime('followup_date');
            $table->boolean('consent_for_contact_back');
            $table->boolean('pwd');
            $table->jsonb('no_of_children'); //{girl: 1, boy: 3}
            $table->jsonb('meta'); //Current User, Ever User, Never User
            $table->string('registered_as', 100); //Client Registered at (HHV, NHM, OM)
            $table->boolean('referred'); 
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
