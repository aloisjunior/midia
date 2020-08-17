<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFonteDadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fonte_dados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 150)->nullable(false); // validção de requerid feita no form e validator no controller
            $table->enum('tipo', ['mysql'])->default('mysql');
            $table->text('dados_conexao');


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
        Schema::dropIfExists('fonte_dados');
    }
}
