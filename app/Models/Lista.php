<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
  protected $table = 'tlista';

  protected $primaryKey = 'codlista';

  public $timestamps = false;

  protected $fillable = [
    'codlista',
    'enunciado',
    'codrespuesta',
  ];

  protected $guarded = [

  ];
}
