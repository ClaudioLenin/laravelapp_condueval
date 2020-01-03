<?php

namespace App\Http\Controllers\Examen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Examen; //Modelo
use App\Models\ExamenPregunta; //Modelo
use DB;

class ExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $tippersona = session()->get('tippersona');
      if ($tippersona == 'Administrativo') {
          return view('admin.examen.index');
      }else if ($tippersona == 'Docente') {
          return view('teacher.examen.index');
      }
    }
    public function mostrarexamenes(Request $request){
      $coddocentemateria = $request->get('coddocentemateria');
      $examenes = DB::table('texamen as e')
     ->select('*')
     ->where('e.coddocentemateria','=',$coddocentemateria)
     ->orderBy('e.codexamen','desc')
     ->paginate(10);
     return view('admin.examen.listexamenes',["examenes"=>$examenes]);
    }
    public function mostrarpreguntasexamen(Request $request){
      $coddocentemateria = $request->get('coddocentemateria');
      $preguntas = DB::select('select * from tpregunta where coddocentemateria = :coddocentemateria',['coddocentemateria' => $coddocentemateria]);
      return json_encode($preguntas);
    }

    public function guardarexamen(Request $request)
    {
      $preguntas = $request->post('preguntas');
      $calificacion = 0;
      $cont = 0;
      foreach ($preguntas as $pregunta) { //recorre el vector de las preguntas seleccionadas
        $valores = DB::selectOne('select valor from tpregunta where codpregunta = :codpregunta',['codpregunta' => $pregunta]);
        $calificacion += $valores->valor;
        $cont++;
      }
      date_default_timezone_set('Etc/GMT+5');
      $hoy = array();
      $hoy = date("Y-m-d H:i:00", time());

      if ($calificacion == 20) {
        $examen = new Examen;
        $examen->descripcion = $request->post('nombre-examen');
        $examen->fechacreacion = $hoy;
        $examen->fechaejecucion = $request->post('fechaejecucion');
        $examen->fechafin = $request->post('fechafin');
        $examen->numpreguntas = $cont;
        $examen->valoracion = $calificacion;
        $examen->clave = $request->post('contrasenia');
        $estado = "";
        if (strtotime($hoy) > strtotime($request->post('fechafin')) || strtotime($request->post('fechaejecucion'))> strtotime($request->post('fechafin'))) {
            $estado = "DESHABILITADO";
        } else {
            $estado = "HABILITADO";
        }
        $examen->estado = $estado;
        $examen->coddocentemateria = $request->post('coddocentemateria');

        $examen->save();

        foreach ($preguntas as $pregunta) { //recorre el vector de las preguntas seleccionadas
          $examenpregunta = new ExamenPregunta;
          $examenpregunta->codpregunta = $pregunta;
          $examenpregunta->codexamen = $examen->codexamen;
          $examenpregunta->save();
        }
        return "OK";
      }
        return "KO";
    }
    public function eliminarexamen(Request $request){
      $codexamen = $request->get('id');
      //$pregunta = DB::selectOne('select  from tpregunta where codpregunta = :codpregunta',['codpregunta' => $codpregunta]);
      DB::delete('delete from texamen where codexamen = :codexamen',['codexamen' => $codexamen]);
      return "OK";
    }

    public function modificarexamen(Request $request){
      date_default_timezone_set('Etc/GMT+5');
      $hoy = array();
      $hoy = date("Y-m-d H:i:00", time());

      $examen=Examen::findOrFail($request->get('codexamen'));
      $examen->descripcion = $request->get('nombre');
      $examen->clave = $request->get('contrasenia');
      if($request->get('fechaejecucion')!="" && $request->get('fechafin')!=""){
        $examen->fechaejecucion = $request->get('fechaejecucion');
        $examen->fechafin = $request->get('fechafin');
        $estado = "";
        if (strtotime($hoy) > strtotime($request->get('fechafin')) || strtotime($request->get('fechaejecucion')) > strtotime($request->get('fechafin'))) {
            $estado = "DESHABILITADO";
        } else {
            $estado = "HABILITADO";
        }
        $examen->estado = $estado;
      }
      $examen->update();
      $codexamen = $request->get('codexamen');
      $exam = DB::select('select * from texamen where codexamen = :codexamen',['codexamen' => $codexamen]);
      return json_encode($exam);


    }
}
