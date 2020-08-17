<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->enum('tipo_pessoa',
                [
                    'PF','PJ'
                ]);
            $table->enum('tipo_cadastro',
                [
                    'C','F', 'A'
                ])->default('C');
            $table->string('nome', 200);
            $table->string('razao_social', 200)->nullable();
            $table->string('cnpj_cpf', 30)->nullable();
            $table->string('inscricao_estadual', 30)->nullable();
            $table->string('inscricao_municipal', 30)->nullable();

            $table->string('email', 100)->nullable();
            $table->string('contato', 100)->nullable();

            $table->string('telefone', 15)->nullable();

            $table->string('endereco', 150)->nullable();
            $table->string('numero', 20)->nullable();
            $table->string('complemento', 100)->nullable();
            $table->string('bairro', 100)->nullable();
            $table->string('cidade', 100)->nullable();
            $table->string('cep', 10)->nullable();

            $table->enum('estado',
                [
                    'AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT',
                    'MS','MG','PA','PB','PR','PE','PI','RR','RO','RJ','RN',
                    'RS','SC','SP','SE','TO'
                ])->nullable();

            $table->string('pais', 100)->nullable()->default('Brasil');

            $table->double('valor_credito', 10, 2)->default('0.00');

            $table->string('classificacao', 100)->nullable();
            $table->enum('dia_pgto',
                [
                    5, 10, 15, 20
                ])->default('5');

            $table->string('observacao', 1000)->nullable();
            $table->string('depoimento_texto', 1000)->nullable();
            $table->string('depoimento_autor', 100)->nullable();
            $table->string('depoimento_cargo', 100)->nullable();


            $table->boolean('receber_mailing')->default(true);
            $table->boolean('ativo')->default(true);
            $table->string('tags', 200)->nullable();

            $table->unsignedInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });

        \Illuminate\Support\Facades\DB::statement('ALTER TABLE clientes ADD FULLTEXT full(
                                                                                        nome,
                                                                                        razao_social, 
                                                                                        cnpj_cpf, 
                                                                                        email, 
                                                                                        contato, 
                                                                                        telefone, 
                                                                                        endereco, 
                                                                                        numero, 
                                                                                        bairro, 
                                                                                        cidade, 
                                                                                        cep,
                                                                                        observacao, 
                                                                                        depoimento_texto, 
                                                                                        depoimento_cargo, 
                                                                                        tags)');


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
