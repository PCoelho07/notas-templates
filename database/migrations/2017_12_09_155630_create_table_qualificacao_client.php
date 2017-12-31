<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableQualificacaoClient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_qualification', function(Blueprint $table) {
            $table->increments('id'); 
            
            $table->integer('client_id')
                    ->unsigned();

            $table->integer('role_id')
                    ->unsigned();


            $table->timestamps();


            $table->foreign('client_id')
                    ->references('id')
                    ->on('clients')
                    ->onDelete('cascade');

            $table->foreign('role_id')
                    ->references('id')
                    ->on('client_roles')
                    ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_qualification');
    }
}
