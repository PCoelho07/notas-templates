<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplateTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_tokens', function(Blueprint $table){
           $table->integer('template_id')->unsigned(); 
           $table->integer('token_id')->unsigned();


           $table->foreign('template_id')
                    ->references('id')
                    ->on('templates')
                    ->onDelete('cascade');

            $table->foreign('token_id')
                    ->references('id')
                    ->on('tokens')
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
        Schema::table('template_tokens', function(Blueprint $table){
            $table->dropForeign(['template_id', 'token_id']);
            $table->dropColumn('template_id');
            $table->dropColumn('token_id');
        });
    }
}
