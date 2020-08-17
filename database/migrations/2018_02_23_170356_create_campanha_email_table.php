<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampanhaEmailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campanha_email', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('nome', 100);
            $table->string('descricao', 300);
            $table->string('assunto', 100);
            $table->string('assunto_reenvio', 100);

            $table->longText('documento');

//            $table->timestamp('data_envio');

            $table->boolean('ativo')->default(true);

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('campanha_id')->unsigned()->nullable();
            $table->foreign('campanha_id')->references('id')->on('campanha')->onDelete('cascade');


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
        Schema::dropIfExists('campanha_email');
    }
}
