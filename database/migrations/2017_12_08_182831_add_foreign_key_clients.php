<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyClients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function(Blueprint $table) {
            $table->integer('client_roles_id')->unsigned();

            $table->foreign('client_roles_id')
                    ->references('id')
                    ->on('client_roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function(Blueprint $table) {
            $table->dropForeign(['client_roles_id']);
        });
    }
}
