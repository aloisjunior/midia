<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtigosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artigos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('titulo');
            $table->string('slug')->unique();
            $table->text('apresentacao');
            $table->text('corpo');
            $table->boolean('published')->default(false);
            $table->boolean('ativo')->default(true);
            $table->string('tags', 200);
            $table->string('tipo', 200);
            $table->string('categorias', 200);
            $table->string('url_video', 300);

            $table->integer('views')->default('50');
            $table->integer('likes');
            $table->unsignedInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');


        });

        \Illuminate\Support\Facades\DB::statement('ALTER TABLE artigos ADD FULLTEXT full(titulo, slug, apresentacao, corpo, tags, categorias, tipo)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artigos');
    }
}
