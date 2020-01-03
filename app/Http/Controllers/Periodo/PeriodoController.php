<?php

namespace App\Http\Controllers\Periodo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;

class PeriodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $json = array();
          $periodos = DB::select('select codperiodo,nomperiodo from tperiodo');
            foreach ($periodos as $periodo => $p) {
              $json[] = array(
                  'codperiodo' => $p->codperiodo,
                  'nomperiodo' => $p->nomperiodo
              );
            }
            $jsonstring = json_encode($json);
            return $jsonstring;
    }
}
