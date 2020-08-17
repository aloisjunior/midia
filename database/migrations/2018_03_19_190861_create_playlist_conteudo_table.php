<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaylistConteudoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlist_conteudo', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nome', 100);

            $table->string('filename', 200)->nullable(true);
            $table->string('mime', 300)->nullable(true);
            $table->string('link', 700)->nullable(true);
            $table->string('thumbnail', 700)->nullable(true);
            $table->string('tempo', 10);
            $table->integer('size' )->default('0');
            $table->string('tags', 200);
            $table->boolean('processado')->default(false);
            $table->date('validade_de');
            $table->date('validade_ate');
            $table->text('agendamento');

//          alteração para inclusão de tipo de conteudo url para taurus
            $table->enum('tipo_conteudo', ['arquivo', 'url', 'streaming'])->default('arquivo');
            $table->string('url', 1500);

            $table->unsignedInteger('user_id')->unsigned()->nullable(false);
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedInteger('cliente_id')->unsigned()->nullable(true);
            $table->foreign('cliente_id')->references('id')->on('clientes');

            $table->boolean('ativo')->default(true);


            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::statement('ALTER TABLE playlist_conteudo ADD FULLTEXT full(
                                                                                        nome,                                                                                                                                                                               
                                                                                        filename,
                                                                                        tags                                                                                        
                                                                                        )');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playlist_conteudo');
    }
}
