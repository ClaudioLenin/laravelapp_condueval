<?php 

namespace App\Models\Seguridad;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
	protected $remember_token = false;
	protected $table = 'tdatosexamen';
	protected $fillable = ['cedula','nombre','foto','password','codpersona','email','descripcion'];
    protected $guarded = ['codusuarios'];
    protected $primaryKey = 'codusuarios';

    
}
