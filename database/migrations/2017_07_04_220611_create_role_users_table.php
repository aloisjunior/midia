<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->Integer('user_id')->unsigned()->nullable();
            $table->Integer('role_id')->unsigned()->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'role_id']);
//            $table->foreign('user_id')->references('id')->on('users');
//            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
