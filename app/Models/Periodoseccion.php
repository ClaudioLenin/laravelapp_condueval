<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periodoseccion extends Model
{
  protected $table = 'tperiodoseccion';

  protected $primaryKey = 'codperiodoseccion';

  public $timestamps = false;

  protected $fillable = [
    'codseccion',
    'codperiodo',
    'numfases',
    'numparalelos'
  ];

  protected $guarded = [

  ];
}
