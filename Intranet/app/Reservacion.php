<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservacion extends Model
{
    protected $table = "reservations";

    protected $fillable = ['Name', 'Description', 'Place',  'Visit', 'People', 'Parking','Supplies', 'System', 'Date', 'Time_start', 'Time_end', 'Employee_id'];

    

}
