<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPlaylistConteudoAudioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('playlist_conteudo', function (Blueprint $table) {
            $table->boolean('force_audio')->nullable(false)->default(false);
//
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('playlist_conteudo', function (Blueprint $table) {
            $table->dropColumn('force_audio');
        });
    }
}
