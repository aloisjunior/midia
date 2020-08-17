<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players_logs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->timestamp('horario')->nullable()->default(null);
            $table->integer('player_id')->unsigned()->nullable();

            $table->integer('local_id')->unsigned()->nullable();

            $table->text('descricao');

            $table->string('tipo_conteudo', 100)->default('nenhum');
            $table->enum('tipo_log', ['playlist', 'player'])->default('playlist');

            $table->integer('conteudo_id')->unsigned()->nullable();


            $table->string('conteudo_nome', 200);
            $table->string('conteudo_arquivo', 200);


            $table->boolean('ativo')->default(true);

//            $table->index('conteudo_id');
//            $table->index('horario');
            $table->unique(['player_id', 'local_id', 'horario' ], 'idx_unique_player_local_horario');

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
        Schema::dropIfExists('players_logs');
    }
}
