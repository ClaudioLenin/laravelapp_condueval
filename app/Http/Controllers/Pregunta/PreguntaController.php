<?php

namespace App\Http\Controllers\Pregunta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pregunta; //Modelo
use App\Models\Respuesta; //Modelo
use App\Models\PreguntaRespuesta; //Modelo
use App\Models\Lista; //Modelo
use App\Models\ListaPregunta; //Modelo
use App\Models\Parte; //Modelo
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;

class PreguntaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request){
       $tippersona = session()->get('tippersona');
       if($tippersona == 'Administrativo'){
           return view('admin.pregunta.index');
       }else if($tippersona == 'Docente'){
           return view('teacher.pregunta.index');
       }
     }
     public function listall(Request $request){
         $coddocentemateria = $request->get('coddocentemateria');
         $preguntas = DB::table('tpregunta as p')
     		->select('p.codpregunta','p.pregunta','p.valor','p.imagen','p.tipo','p.coddocentemateria')
     		->where('p.coddocentemateria','=',$coddocentemateria)
     		->orderBy('p.codpregunta','desc')
     		->paginate(10);

         return view('admin.pregunta.listall',["preguntas"=>$preguntas]);
     }
     public function buscarpregunta(Request $request){
       $coddocentemateria = $request->get('coddocentemateria');
       $search = $request->get('search');
       $preguntas = DB::table('tpregunta as p')
      ->select('p.codpregunta','p.pregunta','p.valor','p.imagen','p.tipo','p.coddocentemateria')
      ->where('p.coddocentemateria','=',$coddocentemateria)
      ->where('p.pregunta','LIKE','%'.$search.'%')
      ->orderBy('p.codpregunta','desc')
      ->paginate(10);

       return view('admin.pregunta.listall',["preguntas"=>$preguntas]);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
      $tipo = $request->post('tipo');
      //PROCESO DE GUARDAR PREGUNTA
      $pregunta = new Pregunta;
    	$pregunta->valor = $request->post('valor');
      $pregunta->tipo = $tipo;
      if($request->file('imagen')!=null){
        $file = $request->file('imagen');
        $file->move(public_path().'/images/resources/',$file->getClientOriginalName());
        $nombre = $file->getClientOriginalName();
        $pregunta->imagen = $nombre;
      }
    	$pregunta->coddocentemateria = $request->post('coddocentemateria');
      if($tipo == 'UNIR' || $tipo == 'COMPLETAR'){
        $pregunta->pregunta = $request->post('enunciado');
      }else {
        $pregunta->pregunta = $request->post('pregunta');
      }
      //PROCESO DE GUARDAR RESPUESTA
      if ($tipo == 'UNIR') { //INGRESAR PREGUNTA DE UNIR
        $codResp = array();
        $listado_preguntas = array();
        $listado_respuestas = array();
        $listado_preguntas = $request->post('preguntas');
        $listado_respuestas = $request->post('respuestas');
        if($listado_preguntas!="" && $listado_respuestas!=""){
          $pregunta->save();
          $i = 0;
          foreach ($listado_respuestas as $lista1) {
              $item1 = new Respuesta;
              $item1->respuesta = $lista1;
              $item1->correcta = "SI";
              $item1->save();
              $codResp[$i] = $item1->codrespuesta;
              $i++;
          }
          $i = 0;
          foreach ($listado_preguntas as $lista2) {
              $item2 = new Lista;
              $item2->enunciado = $lista2;
              $item2->codrespuesta = $codResp[$i];
              $item2->save();
              $unir = new ListaPregunta;
              $unir->codpregunta = $pregunta->codpregunta;
              $unir->codlista = $item2->codlista;
              $unir->save();
              $i++;
          }
        }else{
          return 'ko';
        }

      }else if($tipo == 'COMPLETAR'){ //INGRESAR PREGUNTA DE COMPLETAR
        $cadena = array();
        $k = 1;
        $cadena = $request->post('cadena');
        if($cadena!=""){
          $pregunta->save();
          foreach ($cadena as $posicion => $frase) {
            if ($request->post('ct'))
                for ($j = 0; $j <= $request->post('ct'); $j++)
                    if ($posicion == 'texto' . $j){
                      $texto = new Parte;
                      $texto->codpregunta = $pregunta->codpregunta;
                      $texto->cadena = $frase;
                      $texto->tipo = 'TEXTO';
                      $texto->numero = $k;
                      $texto->save();
                    }
            if ($request->post('cc'))
                for ($i = 0; $i <= $request->post('cc'); $i++)
                    if ($posicion == 'completar' . $i){
                      $completar = new Parte;
                      $completar->codpregunta = $pregunta->codpregunta;
                      $completar->cadena = $frase;
                      $completar->tipo = 'COMPLETAR';
                      $completar->numero = $k;
                      $completar->save();
                    }
            $k++;
          }
        }else{
          return "ko";
        }
      }else if($tipo == 'RESPUESTA SIMPLE'){
        $rsimple = new Respuesta;
        $rsimple->respuesta = $request->post('respuesta');
        $rsimple->correcta = "SI";
        if($rsimple->respuesta != ""){
          $pregunta->save();
          $rsimple->save();
          $pr = new PreguntaRespuesta;
          $pr->codrespuesta = $rsimple->codrespuesta;
          $pr->codpregunta = $pregunta->codpregunta;
          $pr->save();
        }else{
          return "ko";
        }
      }else if($tipo == 'SELECCION SIMPLE'){
        $ssimple = new Respuesta;
        $ssimple->respuesta = $request->post('correcta');
        $ssimple->correcta = "SI";
        $pregunta->save();
        $ssimple->save();
        $pr = new PreguntaRespuesta;
        $pr->codrespuesta = $ssimple->codrespuesta;
        $pr->codpregunta = $pregunta->codpregunta;
        $pr->save();
        $otras = array();
        $otras = $request->post('otras');
        if($otras!=""){
        foreach ($otras as $otra) {
            $incorrectas = new Respuesta;
            $incorrectas->respuesta = $otra;
            $incorrectas->correcta = "NO";
            $incorrectas->save();
            $opr = new PreguntaRespuesta;
            $opr->codrespuesta = $incorrectas->codrespuesta;
            $opr->codpregunta = $pregunta->codpregunta;
            $opr->save();
        }
        }else {
          return 'ko';
        }
      }else if($tipo == 'SELECCION MULTIPLE'){
        $correctas = array();
        $correctas = $request->post('correctas');
        $pregunta->save();
        foreach ($correctas as $correcta) {
          $opcorrecta = new Respuesta;
          $opcorrecta->respuesta = $correcta;
          $opcorrecta->correcta = "SI";
          $opcorrecta->save();
          $opr = new PreguntaRespuesta;
          $opr->codrespuesta = $opcorrecta->codrespuesta;
          $opr->codpregunta = $pregunta->codpregunta;
          $opr->save();
        }
        $otras = array();
        $otras = $request->post('otras');
        if($otras!=""){
          foreach ($otras as $otra) {
            $opincorrecta = new Respuesta;
            $opincorrecta->respuesta = $otra;
            $opincorrecta->correcta = "NO";
            $opincorrecta->save();
            $opr = new PreguntaRespuesta;
            $opr->codrespuesta = $opincorrecta->codrespuesta;
            $opr->codpregunta = $pregunta->codpregunta;
            $opr->save();
          }
        }else {
          return 'ko';
        }
      }else if($tipo == "VERDADERO FALSO"){
        $pregunta->save();
        $opcion = new Respuesta;
        $opcion->respuesta = $request->post('seleccion');
        $opcion->correcta = "SI";
        $opcion->save();
        $opr = new PreguntaRespuesta;
        $opr->codrespuesta = $opcion->codrespuesta;
        $opr->codpregunta = $pregunta->codpregunta;
        $opr->save();
      }
      return "OK";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $tipo = $request->post('tipo');
      $codpregunta = $request->post('codpregunta');
      $pregunta=Pregunta::findOrFail($codpregunta);
      $pregunta->valor = $request->post('valor');
      if($request->file('imagen')!=null){
        $file = $request->file('imagen');
        $file->move(public_path().'/images/resources/',$file->getClientOriginalName());
        $nombre = $file->getClientOriginalName();
        $pregunta->imagen = $nombre;
      }
      $pregunta->pregunta = $request->post('pregunta');
      $pregunta->update();
      //PROCESO DE MODIFICAR PREGUNTA
      if($tipo=='VERDADERO FALSO'){
        $pregunta_respuesta=DB::selectOne('select codrespuesta from tpreguntarespuesta where codpregunta = :codpregunta',['codpregunta' => $codpregunta]);
        $respuesta=Respuesta::findOrFail($pregunta_respuesta->codrespuesta);
        $respuesta->respuesta = $request->post('seleccion');
    	  $respuesta->update();
      }else if($tipo=='COMPLETAR'){
        $partes = DB::select('select codparte from tpartes where codpregunta = :codpregunta',['codpregunta' => $codpregunta]);
        foreach ($partes as $parte) {
            $codparte = $parte->codparte;
            $part=Parte::findOrFail($codparte);
            $part->cadena = $request->post($codparte);
            $part->update();
        }
      }else if($tipo=='UNIR'){
        $listas = DB::select('select tlistapregunta.codlista,tlista.codrespuesta from tlistapregunta inner join tlista on tlistapregunta.codlista = tlista.codlista where codpregunta = :codpregunta',['codpregunta' => $codpregunta]);
        foreach ($listas as $lista) {
            $list=Lista::findOrFail($lista->codlista);
            $resp=Respuesta::findOrFail($lista->codrespuesta);
            $list->enunciado = $request->post($lista->codlista);
            $resp->respuesta = $request->post($lista->codrespuesta);
            $list->update();
            $resp->update();
        }
      }else {
        $respuestas = DB::select('select trespuesta.codrespuesta from trespuesta inner join tpreguntarespuesta on trespuesta.codrespuesta = tpreguntarespuesta.codrespuesta where codpregunta = :codpregunta',['codpregunta' => $codpregunta]);
        foreach ($respuestas as $respuesta) {
            $resp=Respuesta::findOrFail($respuesta->codrespuesta);
            $resp->respuesta = $request->post($respuesta->codrespuesta);
            $resp->update();
        }
      }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $codpregunta = $request->get('id');
      $pregunta = DB::selectOne('select tipo from tpregunta where codpregunta = :codpregunta',['codpregunta' => $codpregunta]);
      if ($pregunta->tipo == "UNIR") {
        $preguntas_respuestas = DB::select('select trespuesta.codrespuesta from tlista inner join trespuesta on trespuesta.codrespuesta = tlista.codrespuesta inner join tlistapregunta on tlistapregunta.codlista = tlista.codlista where codpregunta = :codpregunta',['codpregunta' => $codpregunta]);
        foreach ($preguntas_respuestas as $pregunta_respuesta) {
            $codrespuesta = $pregunta_respuesta->codrespuesta;
            DB::delete('delete from trespuesta where codrespuesta = :codrespuesta',['codrespuesta' => $codrespuesta]);
        }
        DB::delete('delete from tpregunta where codpregunta = :codpregunta',['codpregunta' => $codpregunta]);
      }else if($pregunta->tipo == "COMPLETAR"){
        DB::delete('delete from tpartes where codpregunta = :codpregunta',['codpregunta' => $codpregunta]);
        DB::delete('delete from tpregunta where codpregunta = :codpregunta',['codpregunta' => $codpregunta]);
      }else{
        $respuestas = DB::select('select trespuesta.codrespuesta from trespuesta inner join tpreguntarespuesta on trespuesta.codrespuesta = tpreguntarespuesta.codrespuesta where codpregunta = :codpregunta',['codpregunta' => $codpregunta]);
        foreach ($respuestas as $respuesta) {
            $codrespuesta = $respuesta->codrespuesta;
            DB::delete('delete from trespuesta where codrespuesta = :codrespuesta',['codrespuesta' => $codrespuesta]);
        }
        DB::delete('delete from tpregunta where codpregunta = :codpregunta',['codpregunta' => $codpregunta]);
      }
      return "OK";
    }
}
