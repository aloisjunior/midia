<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nome', 255);
            $table->timestamp('ultimo_sinal')->nullable()->default(null);
            $table->timestamp('ultimo_sinal_service')->nullable()->default(null);
            $table->string('token_id', 255);
            $table->string('token_auth', 255);
            $table->string('token_push_android', 255);

            $table->enum('tipo_cliente', ['android', 'windows'])->default('android');


            $table->boolean('ativo')->default(true);
            $table->string('tags', 200)->nullable();
            $table->string('grupos', 200)->nullable();
            $table->string('app_version', 50)->nullable()->default(null);

            $table->integer('playlist_id')->unsigned()->nullable();
            $table->foreign('playlist_id')->references('id')->on('playlist');


            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->longText('playlist')->nullable()->default(null);

            $table->index('token_id');

            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::statement('ALTER TABLE players ADD FULLTEXT full(
                                                                                        nome,                                                                                                                                                                               
                                                                                        tags                                                                                        
                                                                                        )');



}

/**
 * Reverse the migrations.
 *
 * @return void
 */
public
function down()
{
    Schema::dropIfExists('players');
}
}
