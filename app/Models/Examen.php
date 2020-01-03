<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
  protected $table = 'texamen';

  protected $primaryKey = 'codexamen';

  public $timestamps = false;

  protected $fillable = [
    'codexamen',
    'descripcion',
    'fechacreacion',
    'fechaejecucion',
    'fechafin',
    'numpreguntas',
    'valoracion',
    'clave',
    'estado',
    'coddocentemateria'
  ];

  protected $guarded = [

  ];
}
