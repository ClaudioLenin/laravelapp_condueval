<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreguntaRespuesta extends Model
{
  protected $table = 'tpreguntarespuesta';

  protected $primaryKey = 'codpr';

  public $timestamps = false;

  protected $fillable = [
    'codpr',
    'codrespuesta',
    'codpregunta',
  ];

  protected $guarded = [

  ];
}
