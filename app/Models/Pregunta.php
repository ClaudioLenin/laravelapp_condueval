<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
  protected $table = 'tpregunta';

  protected $primaryKey = 'codpregunta';

  public $timestamps = false;

  protected $fillable = [
    'codpregunta',
    'pregunta',
    'valor',
    'imagen',
    'tipo',
    'coddocentemateria',
  ];

  protected $guarded = [

  ];
}
