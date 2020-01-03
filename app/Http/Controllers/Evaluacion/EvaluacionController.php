<?php

namespace App\Http\Controllers\Evaluacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;

class EvaluacionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $coddocentemateria = $request->get('coddocentemateria');
    $json = array();
    $evaluaciones = DB::select('select * from texamen where coddocentemateria = :coddocentemateria',['coddocentemateria' => $coddocentemateria]);
      foreach ($evaluaciones as $evaluacion => $v) {
        $json[] = array(
            'codexamen' => $v->codexamen,
            'descripcion' => $v->descripcion
        );
      }
      $jsonstring = json_encode($json);
      return $jsonstring;
  }
}
