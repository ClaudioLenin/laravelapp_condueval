<?php

namespace App\Models\Seguridad;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
  protected $table = 'tdatosexamen';

  protected $primaryKey = 'codusuarios';

  public $timestamps = false;

  protected $fillable = ['codusuarios','cedula','nombre','foto','password','codpersona','email','descripcion'];
  protected $guarded = [

  ];
}
