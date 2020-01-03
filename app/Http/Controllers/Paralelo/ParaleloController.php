<?php

namespace App\Http\Controllers\Paralelo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;

class ParaleloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $codperiodoseccion = $request->get('codperiodoseccion');
      $json = array();
      $paralels = DB::select('select codperiodoseccionparalelo,codparalelo from tperiodoseccionparalelo where codperiodoseccion = :codperiodoseccion',['codperiodoseccion' => $codperiodoseccion]);
        foreach ($paralels as $paralel => $p) {
          $json[] = array(
              'codperiodoseccionparalelo' => $p->codperiodoseccionparalelo,
              'codparalelo' => $p->codparalelo
          );
        }
        $jsonstring = json_encode($json);
        return $jsonstring;
    }
}
