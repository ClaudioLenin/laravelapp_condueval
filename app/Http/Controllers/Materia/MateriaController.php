<?php

namespace App\Http\Controllers\Materia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $codperiodoseccionparalelo = $request->get('codperiodoseccionparalelo');
      $json = array();
      $materias = DB::select('select * from tdocentemateria inner join tmateria on tdocentemateria.codmateria = tmateria.codmateria inner join tpersona on tpersona.codpersona = tdocentemateria.codpersona where codperiodoseccionparalelo = :codperiodoseccionparalelo',['codperiodoseccionparalelo' => $codperiodoseccionparalelo]);
        foreach ($materias as $materia => $m) {
          $json[] = array(
              'coddocentemateria' => $m->coddocentemateria,
              'nommateria' => $m->nommateria
          );
        }
        $jsonstring = json_encode($json);
        return $jsonstring;
    }
    public function index2(Request $request)
    {
      $codperiodoseccionparalelo = $request->get('codperiodoseccionparalelo');
      $codpersona = session()->get('codpersona');
      $json = array();
      $materias = DB::select('select * from tdocentemateria inner join tmateria on tdocentemateria.codmateria = tmateria.codmateria inner join tpersona on tpersona.codpersona = tdocentemateria.codpersona where tdocentemateria.codperiodoseccionparalelo = :codperiodoseccionparalelo and tdocentemateria.codpersona = :codpersona',['codperiodoseccionparalelo' => $codperiodoseccionparalelo,'codpersona'=>$codpersona]);

        foreach ($materias as $materia => $m) {
          $json[] = array(
              'coddocentemateria' => $m->coddocentemateria,
              'nommateria' => $m->nommateria
          );
        }
        $jsonstring = json_encode($json);
        return $jsonstring;
    }
}
