<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estacao', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 255);
            $table->string('host', 255);
            $table->string('porta', 5);
            $table->string('key', 255);
            $table->boolean('ativo')->default(true);
            $table->string('tags', 200);

            $table->string('ftp_senha', 60)->default('4t0n');
            $table->string('ftp_pastas_offline', 200)->default('base');

            $table->timestamps();

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
        });

        \Illuminate\Support\Facades\DB::statement('ALTER TABLE estacao ADD FULLTEXT full(
                                                                                        nome,
                                                                                        host, 
                                                                                        porta, 
                                                                                        tags, 
                                                                                        ftp_pastas_offline
                                                                                        )');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estacao');
    }
}
