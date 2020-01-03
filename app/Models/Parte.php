<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parte extends Model
{
  protected $table = 'tpartes';

  protected $primaryKey = 'codparte';

  public $timestamps = false;

  protected $fillable = [
    'codparte',
    'codpregunta',
    'cadena',
    'tipo',
    'numero'
  ];

  protected $guarded = [

  ];
}
