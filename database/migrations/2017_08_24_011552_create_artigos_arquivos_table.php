<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtigosArquivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artigos_arquivos', function (Blueprint $table) {
            $table->increments('id');

            $table->string('filename', 200);
            $table->string('mime', 300);
            $table->string('link', 700);
            $table->integer('size' )->default('0');


            $table->index('filename');

            $table->unsignedInteger('artigos_id')->unsigned()->nullable();
            $table->foreign('artigos_id')->references('id')->on('artigos')->onDelete('cascade');;

            $table->timestamps();

        });

        Schema::table('artigos_arquivos', function (Blueprint $table) {

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artigos_arquivos');
    }
}
