<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recordatorio extends Model
{
    protected $table = "reminders";

    protected $fillable = ['Text', 'By', 'Publication_date', 'Ending_date'];


}
