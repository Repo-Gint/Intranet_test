<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden_mantenimiento extends Model
{
    protected $connection = 'mysql_mantenimiento';
    protected $table = 'orders';
}
