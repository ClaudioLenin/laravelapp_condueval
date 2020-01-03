<?php

namespace App\Http\Controllers\Reporte;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ReporteController extends Controller
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
            return view('admin.reporte.index');
        }else if ($tippersona == 'Docente') {
            return view('teacher.reporte.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reporte1(Request $request)
    {
      $coddocentemateria = $request->get('coddocentemateria');
      $examenes = DB::select('select * from texamen where coddocentemateria = :coddocentemateria order by codexamen desc',['coddocentemateria' => $coddocentemateria]);
      $cadena = "";
      foreach ($examenes as $examen) {
        $cadena .="<tr ide='$examen->codexamen'>";
        $cadena .="<td>";
        $cadena .= $examen->descripcion;
        $cadena .="</td>";
        $cadena .="<td>";
        $cadena .= $examen->fechaejecucion;
        $cadena .="</td>";
        $cadena .="<td>";
        $cantidades = DB::selectOne('select AVG(nota) as promedio, COUNT(nota) as cantidad from tnotafinal where codexamen = :codexamen',['codexamen' => $examen->codexamen]);
        $cadena .= $cantidades->cantidad;
        $cadena .="</td>";
        $cadena .="<td>";
        $cadena .= $cantidades->promedio;
        $cadena .="</td>";
        $cadena .="<td>";
        $cadena .= "<a href='evaluacion?codexamen=$examen->codexamen' target='_blank'><input type='button' class='btn btn-primary' value='Evaluacion' id='Evaluacion' name='Evaluacion'></a>";
        $cadena .="</td>";
        $cadena .="<td>";
        $cadena .= "<a href='solucionario?codexamen=$examen->codexamen' target='_blank'><input type='button' class='btn btn-success' value='Solucionario' id='Solucionario' name='Solucionario'></a>";
        $cadena .="</td>";
        $cadena .="</tr>";
      }
        return $cadena;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function evaluacion(Request $request)
    {
      $codexamen = $request->get('codexamen');
      $codpersona = session()->get('codpersona');
      $examen = DB::select('select texamen.descripcion,texamen.fechaejecucion,texamen.fechafin,texamen.fechacreacion, texamen.codexamen, texamen.estado, tmateria.nommateria from texamen inner join tdocentemateria on texamen.coddocentemateria = tdocentemateria.coddocentemateria inner join tmateria on tdocentemateria.codmateria = tmateria.codmateria where texamen.codexamen = :codexamen',['codexamen' => $codexamen]);
      $todas = DB::select('select p.valor,p.codpregunta,p.pregunta,p.tipo,p.imagen from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta where ep.codexamen = :codexamen',['codexamen' => $codexamen]);
      $p_unir1 = DB::select('select p.codpregunta,l.enunciado,r.respuesta,l.codlista from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta inner join tlistapregunta as lp on p.codpregunta = lp.codpregunta inner join tlista as l on l.codlista = lp.codlista inner join trespuesta as r on r.codrespuesta = l.codrespuesta where ep.codexamen = :codexamen and p.tipo = :tipo order by random()',['codexamen' => $codexamen,'tipo'=>'UNIR']);
      $p_unir2 = DB::select('select p.codpregunta,l.enunciado,r.respuesta,l.codlista from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta inner join tlistapregunta as lp on p.codpregunta = lp.codpregunta inner join tlista as l on l.codlista = lp.codlista inner join trespuesta as r on r.codrespuesta = l.codrespuesta where ep.codexamen = :codexamen and p.tipo = :tipo order by random()',['codexamen' => $codexamen,'tipo'=>'UNIR']);
      $p_completar = DB::select('select pa.cadena, pa.tipo, pa.codparte,p.codpregunta,pa.numero from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta inner join tpartes as pa on pa.codpregunta = p.codpregunta where ep.codexamen = :codexamen and p.tipo = :tipo order by p.codpregunta, pa.numero asc',['codexamen' => $codexamen,'tipo'=>'COMPLETAR']);
      $p_multiple = DB::select('select p.codpregunta,r.respuesta,r.codrespuesta,r.correcta from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta inner join tpreguntarespuesta as pr on p.codpregunta = pr.codpregunta inner join trespuesta as r on r.codrespuesta = pr.codrespuesta where ep.codexamen = :codexamen and p.tipo = :tipo order by random()',['codexamen' => $codexamen,'tipo'=>'SELECCION MULTIPLE']);
      $p_simple = DB::select('select p.codpregunta,r.respuesta,r.codrespuesta,r.correcta from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta inner join tpreguntarespuesta as pr on p.codpregunta = pr.codpregunta inner join trespuesta as r on r.codrespuesta = pr.codrespuesta where ep.codexamen = :codexamen and p.tipo = :tipo order by random()',['codexamen' => $codexamen,'tipo'=>'SELECCION SIMPLE']);
      $p_vf = DB::select('select p.codpregunta,r.respuesta,r.codrespuesta,r.correcta from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta inner join tpreguntarespuesta as pr on p.codpregunta = pr.codpregunta inner join trespuesta as r on r.codrespuesta = pr.codrespuesta where ep.codexamen = :codexamen and p.tipo = :tipo',['codexamen' => $codexamen,'tipo'=>'VERDADERO FALSO']);
      return view('admin.reporte.reporte1',["examen"=>$examen,"todas"=>$todas,"p_unir1"=>$p_unir1,"p_unir2"=>$p_unir2,"p_completar"=>$p_completar,"p_multiple"=>$p_multiple,"p_simple"=>$p_simple,"p_vf"=>$p_vf]);
    }
    public function solucionario(Request $request)
    {
      $codexamen = $request->get('codexamen');
      $codpersona = session()->get('codpersona');
      $examen = DB::select('select texamen.descripcion,texamen.fechaejecucion,texamen.fechafin,texamen.fechacreacion, texamen.codexamen, texamen.estado, tmateria.nommateria from texamen inner join tdocentemateria on texamen.coddocentemateria = tdocentemateria.coddocentemateria inner join tmateria on tdocentemateria.codmateria = tmateria.codmateria where texamen.codexamen = :codexamen',['codexamen' => $codexamen]);
      $todas = DB::select('select p.valor,p.codpregunta,p.pregunta,p.tipo,p.imagen from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta where ep.codexamen = :codexamen',['codexamen' => $codexamen]);
      $p_unir = DB::select('select p.codpregunta,l.enunciado,r.respuesta,l.codlista from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta inner join tlistapregunta as lp on p.codpregunta = lp.codpregunta inner join tlista as l on l.codlista = lp.codlista inner join trespuesta as r on r.codrespuesta = l.codrespuesta where ep.codexamen = :codexamen and p.tipo = :tipo',['codexamen' => $codexamen,'tipo'=>'UNIR']);
      $p_completar = DB::select('select pa.cadena, pa.tipo, pa.codparte,p.codpregunta,pa.numero from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta inner join tpartes as pa on pa.codpregunta = p.codpregunta where ep.codexamen = :codexamen and p.tipo = :tipo order by p.codpregunta, pa.numero asc',['codexamen' => $codexamen,'tipo'=>'COMPLETAR']);
      $p_multiple = DB::select('select p.codpregunta,r.respuesta,r.codrespuesta,r.correcta from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta inner join tpreguntarespuesta as pr on p.codpregunta = pr.codpregunta inner join trespuesta as r on r.codrespuesta = pr.codrespuesta where ep.codexamen = :codexamen and p.tipo = :tipo',['codexamen' => $codexamen,'tipo'=>'SELECCION MULTIPLE']);
      $p_simple = DB::select('select p.codpregunta,r.respuesta,r.codrespuesta,r.correcta from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta inner join tpreguntarespuesta as pr on p.codpregunta = pr.codpregunta inner join trespuesta as r on r.codrespuesta = pr.codrespuesta where ep.codexamen = :codexamen and p.tipo = :tipo',['codexamen' => $codexamen,'tipo'=>'SELECCION SIMPLE']);
      $p_vf = DB::select('select p.codpregunta,r.respuesta,r.codrespuesta,r.correcta from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta inner join tpreguntarespuesta as pr on p.codpregunta = pr.codpregunta inner join trespuesta as r on r.codrespuesta = pr.codrespuesta where ep.codexamen = :codexamen and p.tipo = :tipo',['codexamen' => $codexamen,'tipo'=>'VERDADERO FALSO']);
      return view('admin.reporte.reporte11',["examen"=>$examen,"todas"=>$todas,"p_unir"=>$p_unir,"p_completar"=>$p_completar,"p_multiple"=>$p_multiple,"p_simple"=>$p_simple,"p_vf"=>$p_vf]);
    }
    public function docente(Request $request)
    {
      $coddocentemateria = $request->get('coddocentemateria');
      $docente = DB::selectOne('select p.nompersona,p.apepersona,p.codpersona from tpersona as p inner join tdocentemateria as m on m.codpersona = p.codpersona where m.coddocentemateria = :coddocentemateria',['coddocentemateria' => $coddocentemateria]);
      return "<b>Docente: </b>".$docente->nompersona." ".$docente->apepersona;
    }
    //------------------------------REPORTE 2
    public function reporte2(Request $request)
    {
      $codperiodoseccionparalelo = $request->get('codperiodoseccionparalelo');
      $tippersona = session()->get('tippersona');
      if($tippersona == 'Administrativo'){
        $materias = DB::select('select p.nompersona,p.apepersona,m.nommateria,d.coddocentemateria from tmateria as m inner join tdocentemateria as d on m.codmateria = d.codmateria inner join tpersona as p on p.codpersona = d.codpersona where d.codperiodoseccionparalelo = :codperiodoseccionparalelo',['codperiodoseccionparalelo' => $codperiodoseccionparalelo]);
      }
      else if($tippersona == 'Docente'){
        $codpersona = session()->get('codpersona');
        $materias = DB::select('select p.nompersona,p.apepersona,m.nommateria,d.coddocentemateria from tmateria as m inner join tdocentemateria as d on m.codmateria = d.codmateria inner join tpersona as p on p.codpersona = d.codpersona where d.codperiodoseccionparalelo = :codperiodoseccionparalelo and p.codpersona = :codpersona',['codperiodoseccionparalelo' => $codperiodoseccionparalelo,'codpersona'=>$codpersona]);
      }

      $cadena = "";
      foreach ($materias as $materia) {
        $cadena .="<tr>";
        $cadena .="<td>";
        $cadena .= $materia->nommateria;
        $cadena .="</td>";
        $cadena .="<td>";
        $cadena .= $materia->nompersona;
        $cadena .= " ";
        $cadena .= $materia->apepersona;
        $cadena .="</td>";
        $cadena .="<td>";
        $cantidades = DB::selectOne('select count(codexamen) as cantidad from texamen where coddocentemateria = :coddocentemateria',['coddocentemateria' => $materia->coddocentemateria]);
        $cadena .= $cantidades->cantidad;
        $cadena .="</td>";
        $cadena .="</tr>";
      }
      return $cadena;
    }
    public function imprimirReporte2(Request $request)
    { $codperiodo = $request->get('codperiodo');
      $codperiodoseccion = $request->get('codperiodoseccion');
      $codperiodoseccionparalelo = $request->get('codperiodoseccionparalelo');
      $periodo = DB::select('select nomperiodo from tperiodo where codperiodo = :codperiodo',['codperiodo' => $codperiodo]);
      $seccion = DB::select('select s.nomseccion from tperiodoseccion as p inner join tseccion as s on p.codseccion = s.codseccion where p.codperiodoseccion = :codperiodoseccion',['codperiodoseccion' => $codperiodoseccion]);
      $paralelo = DB::select('select codparalelo from tperiodoseccionparalelo as p where p.codperiodoseccionparalelo = :codperiodoseccionparalelo',['codperiodoseccionparalelo' => $codperiodoseccionparalelo]);
      $tippersona = session()->get('tippersona');
      if($tippersona == 'Administrativo'){
        $materias = DB::select('select p.nompersona,p.apepersona,m.nommateria,d.coddocentemateria from tmateria as m inner join tdocentemateria as d on m.codmateria = d.codmateria inner join tpersona as p on p.codpersona = d.codpersona where d.codperiodoseccionparalelo = :codperiodoseccionparalelo',['codperiodoseccionparalelo' => $codperiodoseccionparalelo]);
      }
      else if($tippersona == 'Docente'){
        $codpersona = session()->get('codpersona');
        $materias = DB::select('select p.nompersona,p.apepersona,m.nommateria,d.coddocentemateria from tmateria as m inner join tdocentemateria as d on m.codmateria = d.codmateria inner join tpersona as p on p.codpersona = d.codpersona where d.codperiodoseccionparalelo = :codperiodoseccionparalelo and p.codpersona = :codpersona',['codperiodoseccionparalelo' => $codperiodoseccionparalelo,'codpersona'=>$codpersona]);
      }
      //$materias = DB::select('select p.nompersona,p.apepersona,m.nommateria,d.coddocentemateria from tmateria as m inner join tdocentemateria as d on m.codmateria = d.codmateria inner join tpersona as p on p.codpersona = d.codpersona where d.codperiodoseccionparalelo = :codperiodoseccionparalelo',['codperiodoseccionparalelo' => $codperiodoseccionparalelo]);
      $count = array();
      foreach ($materias as $materia) {
        $cantidades = DB::selectOne('select count(codexamen) as cantidad from texamen where coddocentemateria = :coddocentemateria',['coddocentemateria' => $materia->coddocentemateria]);
        $count += array($materia->coddocentemateria => $cantidades->cantidad);
      }
      return view('admin.reporte.reporte2',["periodo"=>$periodo,"seccion"=>$seccion,"paralelo"=>$paralelo,"materias"=>$materias,"count"=>$count]);
    }
    public function reporte3(Request $request)
    {
      $coddocentemateria = $request->get('coddocentemateria');
      $evaluaciones = DB::select('select * from texamen  as e where e.coddocentemateria = :coddocentemateria',['coddocentemateria' => $coddocentemateria]);

      $cadena = "";
      foreach ($evaluaciones as $evaluacion) {
        $cadena .="<tr>";
        $cadena .="<td>";
        $cadena .= $evaluacion->descripcion;
        $cadena .="</td>";
        $cadena .="<td>";
        $cadena .= $evaluacion->fechaejecucion;
        $cadena .="</td>";
        $cadena .="<td>";
        $cantidades = DB::selectOne('select count(nota) as cantidad,avg(nota) as promedio from tnotafinal where codexamen = :codexamen',['codexamen' => $evaluacion->codexamen]);
        $cadena .= $cantidades->cantidad;
        $cadena .="</td>";
        $cadena .="<td>";
        $cadena .= $cantidades->promedio;
        $cadena .="</td>";
        $cadena .="</tr>";
      }
      return $cadena;
    }
    public function imprimirReporte3(Request $request)
    { $codperiodo = $request->get('codperiodo3');
      $codperiodoseccion = $request->get('codperiodoseccion3');
      $codperiodoseccionparalelo = $request->get('codperiodoseccionparalelo3');
      $coddocentemateria = $request->get('coddocentemateria3');
      $periodo = DB::select('select nomperiodo from tperiodo where codperiodo = :codperiodo',['codperiodo' => $codperiodo]);
      $seccion = DB::select('select s.nomseccion from tperiodoseccion as p inner join tseccion as s on p.codseccion = s.codseccion where p.codperiodoseccion = :codperiodoseccion',['codperiodoseccion' => $codperiodoseccion]);
      $paralelo = DB::select('select codparalelo from tperiodoseccionparalelo as p where p.codperiodoseccionparalelo = :codperiodoseccionparalelo',['codperiodoseccionparalelo' => $codperiodoseccionparalelo]);
      $materias = DB::select('select p.nompersona,p.apepersona,m.nommateria from tdocentemateria as t inner join tpersona as p on t.codpersona = p.codpersona inner join tmateria as m on m.codmateria = t.codmateria where coddocentemateria = :coddocentemateria',['coddocentemateria' => $coddocentemateria]);
      $cantidad = array();
      $promedio = array();
      $evaluaciones = DB::select('select * from texamen  as e where e.coddocentemateria = :coddocentemateria',['coddocentemateria' => $coddocentemateria]);
      foreach ($evaluaciones as $evaluacion) {
        $cantidades = DB::selectOne('select count(nota) as cantidad,avg(nota) as promedio from tnotafinal where codexamen = :codexamen',['codexamen' => $evaluacion->codexamen]);
        $cantidad += array($evaluacion->codexamen => $cantidades->cantidad);
        $promedio += array($evaluacion->codexamen => $cantidades->promedio);
      }
      return view('admin.reporte.reporte3',["periodo"=>$periodo,"seccion"=>$seccion,"paralelo"=>$paralelo,"materias"=>$materias,'evaluaciones'=>$evaluaciones,'cantidad'=>$cantidad,'promedio'=>$promedio]);
    }
    public function reporte4(Request $request)
    {
      $codexamen = $request->get('codexamen');
      $examenes = DB::select('select p.nompersona,p.apepersona,n.codexamen,n.codestudianteparalelo,n.nota from testudianteparalelo as ep inner join tnotafinal as n on ep.codestudianteparalelo = n.codestudianteparalelo inner join tpersona as p on p.codpersona = ep.codestudiante where n.codexamen = :codexamen',['codexamen' => $codexamen]);

      $cadena = "";
      foreach ($examenes as $examen) {
        $cadena .="<tr ide='$examen->codexamen' ides='$examen->codestudianteparalelo'>";
        $cadena .="<td>";
        $cadena .= $examen->nompersona;
        $cadena .= " ";
        $cadena .= $examen->apepersona;
        $cadena .="</td>";
        $cadena .="<td>";
        $cadena .= $examen->nota;
        $cadena .="</td>";
        $cadena .="<td>";
        $cadena .= "<a href='evaluacion_estudiante?codexamen=$examen->codexamen&codestudianteparalelo=$examen->codestudianteparalelo' target='_blank'><input type='button' class='btn btn-primary' value='Evaluacion' id='Evaluacion' name='Evaluacion'></a>";
        $cadena .="</td>";
        $cadena .="</tr>";
      }
        return $cadena;
    }
    public function evaluacion_estudiante(Request $request){
      $codexamen = $request->get('codexamen');
      $codestudianteparalelo = $request->get('codestudianteparalelo');
      $examen = DB::select('select texamen.descripcion,texamen.fechaejecucion,texamen.fechafin,texamen.fechacreacion, texamen.codexamen, texamen.estado, tmateria.nommateria from texamen inner join tdocentemateria on texamen.coddocentemateria = tdocentemateria.coddocentemateria inner join tmateria on tdocentemateria.codmateria = tmateria.codmateria where texamen.codexamen = :codexamen',['codexamen' => $codexamen]);
      $todas = DB::select('select p.valor,p.codpregunta,p.pregunta,p.tipo,p.imagen from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta where ep.codexamen = :codexamen',['codexamen' => $codexamen]);
      $p_unir = DB::select('select p.codpregunta,l.enunciado,r.respuesta,l.codlista from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta inner join tlistapregunta as lp on p.codpregunta = lp.codpregunta inner join tlista as l on l.codlista = lp.codlista inner join trespuesta as r on r.codrespuesta = l.codrespuesta where ep.codexamen = :codexamen and p.tipo = :tipo',['codexamen' => $codexamen,'tipo'=>'UNIR']);
      $p_completar = DB::select('select pa.cadena, pa.tipo, pa.codparte,p.codpregunta,pa.numero from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta inner join tpartes as pa on pa.codpregunta = p.codpregunta where ep.codexamen = :codexamen and p.tipo = :tipo order by p.codpregunta, pa.numero asc',['codexamen' => $codexamen,'tipo'=>'COMPLETAR']);
      $p_multiple = DB::select('select p.codpregunta,r.respuesta,r.codrespuesta,r.correcta from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta inner join tpreguntarespuesta as pr on p.codpregunta = pr.codpregunta inner join trespuesta as r on r.codrespuesta = pr.codrespuesta where ep.codexamen = :codexamen and p.tipo = :tipo',['codexamen' => $codexamen,'tipo'=>'SELECCION MULTIPLE']);
      $p_simple = DB::select('select p.codpregunta,r.respuesta,r.codrespuesta,r.correcta from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta inner join tpreguntarespuesta as pr on p.codpregunta = pr.codpregunta inner join trespuesta as r on r.codrespuesta = pr.codrespuesta where ep.codexamen = :codexamen and p.tipo = :tipo',['codexamen' => $codexamen,'tipo'=>'SELECCION SIMPLE']);
      $p_vf = DB::select('select p.codpregunta,r.respuesta,r.codrespuesta,r.correcta from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta inner join tpreguntarespuesta as pr on p.codpregunta = pr.codpregunta inner join trespuesta as r on r.codrespuesta = pr.codrespuesta where ep.codexamen = :codexamen and p.tipo = :tipo',['codexamen' => $codexamen,'tipo'=>'VERDADERO FALSO']);
      $persona = DB::selectOne('select p.nompersona,p.apepersona from tpersona as p inner join testudianteparalelo as e on p.codpersona = e.codestudiante where e.codestudianteparalelo = :codestudianteparalelo',['codestudianteparalelo' => $codestudianteparalelo]);


      $r_estudiante = DB::select('select * from testudianterespuesta where codexamen = :codexamen and codestudiante = :codestudiante',['codexamen' => $codexamen,'codestudiante'=>$codestudianteparalelo]);
      $nota = DB::selectOne('select nota from tnotafinal where codestudianteparalelo = :codestudianteparalelo and codexamen = :codexamen',['codestudianteparalelo'=>$codestudianteparalelo,'codexamen' => $codexamen]);
      return view('admin.reporte.reporte4',["examen"=>$examen,"todas"=>$todas,"p_unir"=>$p_unir,"p_completar"=>$p_completar,"p_multiple"=>$p_multiple,"p_simple"=>$p_simple,"p_vf"=>$p_vf,"r_estudiante"=>$r_estudiante,'nota'=>$nota,'persona'=>$persona]);
    }
}
