<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id'); // laravel 5.8
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('password_md5', 60)->nullable();
            $table->boolean('ativo')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->longText('config')->nullable()->default(null);
            $table->rememberToken();
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::statement('ALTER TABLE users ADD FULLTEXT full(name, email)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
