<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvisoArchivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_notices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Name_file');
            $table->unsignedBigInteger('Notice_id');

            $table->foreign('Notice_id')->references('id')->on('notices');
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
        Schema::dropIfExists('file_notices');
    }
}
