<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Name');
            $table->string('Description');
            $table->string('Place');
            $table->string('Visit')->nullable();
            $table->string('People')->nullable();
            $table->integer('Parking')->nullable();
            $table->string('Supplies')->nullable();
            $table->string('System')->nullable();
            $table->date('Date');
            $table->time('Time_start');
            $table->time('Time_end');
            $table->unsignedBigInteger('Employee_id');

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
        Schema::dropIfExists('reservations');
    }
}
