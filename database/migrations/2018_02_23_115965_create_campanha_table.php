<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampanhaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campanha', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('nome', 100);
            $table->string('descricao', 300);


            $table->timestamp('data_inicio_envio');
            $table->integer('intervalo_dias_envio')->default('1');

            $table->integer('dias_reenvio')->default('0');

            $table->boolean('ativo')->default(true);
            $table->boolean('inicio_imediato')->default(true);

            $table->integer('atraso_inicio_envio')->default('0');

            $table->string('tags_incluir', 200);
            $table->string('tags_excluir', 200);

            $table->enum('escopo', ['clientes', 'contatos', 'ambos'])->default('ambos');



            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');


            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::statement('ALTER TABLE campanha ADD FULLTEXT full( nome,
                                                                                          descricao, 
                                                                                          tags_incluir,
                                                                                          tags_excluir                                                                                                                                                                                    
                                                                                          )
                                                                                          ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campanha');
    }
}
