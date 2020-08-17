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

            $table->string('nome', 150);
            $table->string('empresa', 150)->nullable();
            $table->string('cargo', 150)->nullable();
            $table->string('url', 150)->nullable();

            $table->string('telefone', 25)->nullable();

            $table->string('endereco', 350)->nullable();

            $table->string('email', 100)->nullable();

            $table->string('observacao', 1000)->nullable();

            $table->enum('status', ['0', '1', '2', '3'])->default('0')->comments('0=novo  | 1=em atendimento | 2=recontactar | 3=convertido');
            $table->enum('cod_origem', ['1', '2', '3'])->default('1')->comments('1=manual/normal | 2=captura | 3=importacao');
            $table->string('origem_detalhe', 255)->nullable();

            $table->string('tags', 200);

            $table->boolean('revisita')->default(false);
            $table->boolean('receber_mailing')->default(true);
            $table->boolean('ativo')->default(true);

            $table->timestamps();

        });


        \Illuminate\Support\Facades\DB::statement('ALTER TABLE contatos ADD FULLTEXT full(
              nome, empresa, cargo, url, telefone, endereco, email, observacao)');


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
