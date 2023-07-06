<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('change_requests', function (Blueprint $table) {
            $table->string('id', 11);
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('no action')->onDelete('no action');
            $table->bigInteger('proyek_id')->unsigned();
            $table->foreign('proyek_id')->references('id')->on('projects')->onUpdate('no action')->onDelete('no action');
            $table->bigInteger('modul_id')->unsigned();
            $table->foreign('modul_id')->references('id')->on('moduls')->onUpdate('no action')->onDelete('no action');
            $table->bigInteger('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('status')->onUpdate('no action')->onDelete('no action');
            $table->string('judul', 11);
            $table->string('deskripsi', 225);
            $table->bigInteger('developer')->unsigned();
            $table->foreign('developer')->references('id')->on('users')->onUpdate('no action')->onDelete('no action');
            $table->bigInteger('tester')->unsigned();
            $table->foreign('tester')->references('id')->on('users')->onUpdate('no action')->onDelete('no action');
            $table->bigInteger('it_operator')->unsigned();
            $table->foreign('it_operator')->references('id')->on('users')->onUpdate('no action')->onDelete('no action');
            $table->bigInteger('current')->unsigned();
            $table->foreign('current')->references('id')->on('users')->onUpdate('no action')->onDelete('no action');
            $table->timestamp('batas_waktu');
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
        Schema::dropIfExists('change_requests');
    }
};
