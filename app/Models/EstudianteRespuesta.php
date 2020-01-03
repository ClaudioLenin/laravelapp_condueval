<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstudianteRespuesta extends Model
{
  protected $table = 'testudianterespuesta';

  protected $primaryKey = 'codrespuesta';

  public $timestamps = false;

  protected $fillable = [
    'codrespuesta',
    'pregunta',
    'respuesta',
    'valor',
    'codpregunta',
    'numero',
    'codexamen',
    'codestudiante'
  ];

  protected $guarded = [

  ];
}
