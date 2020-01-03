<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamenPregunta extends Model
{
  protected $table = 'texamenpregunta';

  protected $primaryKey = 'codep';

  public $timestamps = false;

  protected $fillable = [
    'codep',
    'codexamen',
    'codpregunta'
  ];

  protected $guarded = [

  ];
}
