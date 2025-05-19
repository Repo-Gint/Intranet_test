<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sin_incidente extends Model
{
     protected $table = "incidents";

    protected $fillable = ['Incident_day', 'Reason'];
}
