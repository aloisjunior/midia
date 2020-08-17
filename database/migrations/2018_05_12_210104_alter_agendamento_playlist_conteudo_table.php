<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAgendamentoPlaylistConteudoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('playlist_conteudo', function (Blueprint $table) {
//            $table->date('validade_de')->nullable(true)->default(null);
//            $table->date('validade_ate')->nullable(true)->default(null);
//            $table->text('agendamento')->nullable(true)->default(null);
//
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('playlist_conteudo', function (Blueprint $table) {
            //
        });
    }
}
