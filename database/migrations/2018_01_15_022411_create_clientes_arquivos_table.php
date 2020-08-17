<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesArquivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes_arquivos', function (Blueprint $table) {
            $table->increments('id');

            $table->string('filename', 200);
            $table->string('mime', 300);
            $table->string('link', 700);
            $table->integer('size' )->default('0');


            $table->index('filename');

            $table->unsignedInteger('clientes_id')->unsigned()->nullable();
            $table->foreign('clientes_id')->references('id')->on('clientes');

            $table->timestamps();

        });

        Schema::table('clientes_arquivos', function (Blueprint $table) {

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes_arquivos');
    }
}
