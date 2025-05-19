<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvisoImagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_notice', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Name_image');
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
        Schema::dropIfExists('image_notices');
    }
}
