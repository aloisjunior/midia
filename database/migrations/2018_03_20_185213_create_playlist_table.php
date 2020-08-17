<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaylistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlist', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nome', 100);

            $table->unsignedInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->boolean('ativo')->default(true);

            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::statement('ALTER TABLE playlist ADD FULLTEXT full(
                                                                                        nome                                                                             
                                                                                        )');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playlist');
    }
}
