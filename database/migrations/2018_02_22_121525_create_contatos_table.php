<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contatos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('nome', 150)->nullable(); // validção de requerid feita no form e validator no controller
            $table->string('empresa', 150)->nullable();
            $table->string('cargo', 150)->nullable();
            $table->string('url', 150)->nullable();

            $table->string('telefone', 25)->nullable();

            $table->string('endereco', 350)->nullable();

            $table->string('email', 100)->nullable()->unique();

            $table->string('observacao', 1000)->nullable();

            $table->enum('cod_origem', ['1', '2', '3'])->default('1')->comments('1=manual/normal | 2=captura | 3=importacao');
            $table->string('origem_detalhe', 255)->nullable();

            $table->string('tags', 300)->nullable();
            $table->string('bounce', 300)->nullable()->default('Não classificado');
            $table->string('classificacao', 300)->nullable()->default('Não classificado');

            $table->boolean('receber_mailing')->default(true);
            $table->boolean('ativo')->default(true);

            $table->timestamp('data_confirmacao')->nullable();

            $table->timestamps();

        });


        \Illuminate\Support\Facades\DB::statement('ALTER TABLE contatos ADD FULLTEXT full(
              nome, empresa, cargo, url, telefone, endereco, email, observacao, tags, bounce, classificacao)');


        Schema::disableForeignKeyConstraints();

        Schema::table('contatos', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::enableForeignKeyConstraints();



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contatos');
    }
}
