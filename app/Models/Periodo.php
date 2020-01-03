<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
  protected $table = 'tperiodo';

  protected $primaryKey = 'codperiodo';

  public $timestamps = false;

  protected $fillable = [
    'codperiodo',
    'nomperiodo',
  ];

  protected $guarded = [

  ];
}
