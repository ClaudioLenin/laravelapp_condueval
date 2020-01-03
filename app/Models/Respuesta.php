<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
  protected $table = 'trespuesta';

  protected $primaryKey = 'codrespuesta';

  public $timestamps = false;

  protected $fillable = [
    'codrespuesta',
    'respuesta',
    'correcta',
  ];

  protected $guarded = [

  ];
}
