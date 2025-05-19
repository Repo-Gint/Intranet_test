<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermisosSalidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exit_permits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('working_hours');
            $table->Boolean('enjoy_salary');
            $table->Date('date');
            $table->Time('departure_time');
            $table->Time('return_time');
            $table->Text('reason');
            $table->Boolean('approved')->nullable();
            $table->Text('comments')->nullable();
            $table->String('way_to_pay');
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
        Schema::dropIfExists('exit_permits');
    }
}
