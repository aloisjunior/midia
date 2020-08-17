<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaylistPlaylistConteudoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlist_playlist_conteudo', function (Blueprint $table) {
            $table->increments('id');

            $table->Integer('playlist_id')->unsigned()->nullable();
            $table->Integer('playlist_conteudo_id')->unsigned()->nullable();
            $table->string('tag_carrossel', 100)->nullable(true);
            $table->enum('tipo', ['carrossel', 'conteudo', 'html', 'rss', 'subplaylist', 'layout', 'url', 'streaming']);
            $table->string('tempo', 10)->default('00:15');
            $table->Integer('subplaylist_id')->nullable();
            $table->Integer('layout_id')->nullable();

            $table->index('tag_carrossel');
            $table->index('playlist_id');

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
        Schema::dropIfExists('playlist_playlist_conteudo');
    }
}
