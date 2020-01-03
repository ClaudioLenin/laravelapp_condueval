<?php

namespace App\Http\Controllers\Respuesta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;

class RespuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function mostrarrespuesta(Request $request) {
       $codpregunta = $request->get('codpregunta');
       $pregunta = DB::selectOne('select tipo from tpregunta where codpregunta = :codpregunta',['codpregunta' => $codpregunta]);
       $cadena="";
       if ($pregunta->tipo == "UNIR") {
         $preguntas_respuestas = DB::select('select trespuesta.codrespuesta, tlista.codlista, trespuesta.respuesta,tlista.enunciado,trespuesta.correcta from tlista inner join trespuesta on trespuesta.codrespuesta = tlista.codrespuesta inner join tlistapregunta on tlistapregunta.codlista = tlista.codlista where codpregunta = :codpregunta',['codpregunta' => $codpregunta]);
         return json_encode($preguntas_respuestas);
       }else if($pregunta->tipo == "COMPLETAR"){
         $frases = DB::select('select codparte,cadena,tipo from tpartes where codpregunta = :codpregunta order by numero asc',['codpregunta' => $codpregunta]);
         return json_encode($frases);
       }else if($pregunta->tipo == "VERDADERO FALSO"){
         $respuestas = DB::select('select trespuesta.respuesta from trespuesta inner join tpreguntarespuesta on trespuesta.codrespuesta = tpreguntarespuesta.codrespuesta where codpregunta = :codpregunta',['codpregunta' => $codpregunta]);
         return json_encode($respuestas);
       }else{
         $respuestas = DB::select('select trespuesta.codrespuesta,trespuesta.respuesta,trespuesta.correcta from trespuesta inner join tpreguntarespuesta on trespuesta.codrespuesta = tpreguntarespuesta.codrespuesta where codpregunta = :codpregunta',['codpregunta' => $codpregunta]);
         return json_encode($respuestas);
       }
      return $cadena;
     }
}
