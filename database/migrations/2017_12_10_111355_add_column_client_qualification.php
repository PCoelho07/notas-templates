<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnClientQualification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_qualification', function(Blueprint $table) {

            $table->integer('template_id')->unsigned();

            $table->foreign('template_id')
                    ->references('id')
                    ->on('templates')
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
        Schema::table('client_qualification', function(Blueprint $table) {

            $table->dropForeign(['template_id']);
            $table->dropColumn('template_id');


        });
    }
}
