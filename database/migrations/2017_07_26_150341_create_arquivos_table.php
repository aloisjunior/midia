<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArquivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arquivos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('nome', 100);
            $table->string('descricao', 300);
            $table->string('mime', 300);
            $table->string('link', 700);
            $table->string('tags', 200);

            $table->boolean('ativo')->default(true);

            $table->boolean('exibe_site')->default(false);

            $table->string('filename', 200);

            $table->index('filename');

            $table->timestamps();
        });


        Schema::disableForeignKeyConstraints();

        Schema::table('arquivos', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->unsigned()->nullable(false);
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::enableForeignKeyConstraints();

        \Illuminate\Support\Facades\DB::statement('ALTER TABLE arquivos ADD FULLTEXT full(nome, descricao, mime, link, tags, filename)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arquivos');
    }
}
