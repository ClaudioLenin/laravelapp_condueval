<?php

namespace App\Http\Controllers\Seccion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;

class SeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $codperiodo = $request->get('codperiodo');
      $json = array();
      $sections = DB::select('select codperiodoseccion,nomseccion from tperiodoseccion inner join tseccion on tperiodoseccion.codseccion = tseccion.codseccion where codperiodo = :codperiodo',['codperiodo' => $codperiodo]);
        foreach ($sections as $section => $s) {
          $json[] = array(
              'codperiodoseccion' => $s->codperiodoseccion,
              'nomseccion' => $s->nomseccion
          );
        }
        $jsonstring = json_encode($json);
        return $jsonstring;
    }
}
