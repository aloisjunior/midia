<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOcorrenciasContatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ocorrencias_contatos', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('data')->useCurrent();
            $table->string('descricao', 250 );


            $table->timestamps();
        });

//        Schema::disableForeignKeyConstraints();

        Schema::table('ocorrencias_contatos', function (Blueprint $table) {
            $table->unsignedInteger('contatos_id')->unsigned()->nullable();
            $table->foreign('contatos_id')->references('id')->on('contatos');
        });

//        Schema::enableForeignKeyConstraints();


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ocorrencias_contatos');
    }
}
