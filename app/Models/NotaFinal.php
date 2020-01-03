<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotaFinal extends Model
{
  protected $table = 'tnotafinal';

  protected $primaryKey = array('codexamen','codestudianteparalelo');

  public $timestamps = false;

  protected $fillable = [
    'codexamen',
    'codestudianteparalelo',
    'nota'
  ];

  protected $guarded = [

  ];
}
