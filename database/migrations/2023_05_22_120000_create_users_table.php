<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->bigInteger('tipe_user_id')->unsigned();
            $table->foreign('tipe_user_id')->references('id')->on('tipe_users')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('perusahaan_id')->unsigned();
            $table->foreign('perusahaan_id')->references('id')->on('companies')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name', 50);
            $table->string('email', 50)->unique();
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('nama_lengkap', 100);
            $table->string('kontak', 14);
            $table->rememberToken();
            $table->timestamps();
        });
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
