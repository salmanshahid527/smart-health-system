<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        // DB::select("SELECT pg_catalog.setval('public.clients_id_seq', 604, true);");
        // DB::select("SELECT pg_catalog.setval('public.users_id_seq', 55, true);");
        DB::select("GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO lsssmarthealth;");
        DB::select("GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO lsssmarthealth;");
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
