<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListaPregunta extends Model
{
  protected $table = 'tlistapregunta';

  protected $primaryKey = 'codlp';

  public $timestamps = false;

  protected $fillable = [
    'codlp',
    'codpregunta',
    'codlista',
  ];

  protected $guarded = [

  ];
}
