<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
  protected $table = 'tseccion';

  protected $primaryKey = 'codseccion';

  public $timestamps = false;

  protected $fillable = [
    'codseccion',
    'nomseccion',
  ];

  protected $guarded = [

  ];
}
