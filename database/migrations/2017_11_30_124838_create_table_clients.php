<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableClients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');

            // General Info
            $table->string('name', 150);
            $table->date('born_in')->nullable();

            $table->string('mother', 150)->nullable();
            $table->string('father', 150)->nullable();

            $table->string('nationality')->nullable();
            $table->string('natural_city')->nullable();
            $table->string('natural_state')->nullable();
            $table->string('natural_country')->nullable();
            $table->string('profession')->nullable();

            $table->boolean('gender')->default(false);

            // Spouse info
            $table->integer('civil_status')->unsigned()->nullable();
            $table->string('spouse', 150)->nullable();
            $table->integer('property_regime')->unsigned()->nullable();
            $table->date('married_in')->nullable();
            $table->string('marriage_registry')->nullable();
            $table->string('marriage_term')->nullable();
            $table->string('marriage_book')->nullable();
            $table->string('marriage_sheet')->nullable();
            $table->string('marriage_notary_office')->nullable();

            $table->string('covenant_notary_office')->nullable();
            $table->string('covenant_registry')->nullable();
            $table->integer('older_children')->nullable();
            $table->integer('minor_children')->nullable();
            $table->integer('children_responsible')->nullable();

            // Document
            $table->integer('document_type')->unsigned()->nullable();
            $table->string('document_number')->nullable();
            $table->string('document_issuer_name')->nullable();
            $table->string('document_issuer_state', 2)->nullable();
            $table->date('document_expires_in')->nullable();

            // CPF | CNPJ
            $table->integer('status_cpfcnpj');
            $table->string('cpfcnpj')->nullable();

            // OAB
            $table->string('oab_number')->nullable();
            $table->string('oab_state', 2)->nullable();

            // Address
            $table->string('street_name', 40);
            $table->string('building_number', 6);
            $table->string('complement', 20)->nullable();
            $table->string('neighborhood', 20)->nullable();
            $table->string('zip_code', 8)->nullable();
            $table->string('city', 30);
            $table->string('ibge_code')->nullable();
            $table->string('state', 2);
            $table->string('country')->nullable();

            // Contact info
            $table->string('phone_number')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('email')->nullable();

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
}
