<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class Reporte1Controller extends Controller
{
    public function reporte1(Request $request){
      $codexamen = $request->get('codexamen');
      $codpersona = session()->get('codpersona');
      $examen = DB::select('select texamen.descripcion,texamen.fechaejecucion,texamen.fechafin,texamen.fechacreacion, texamen.codexamen, texamen.estado, tmateria.nommateria from texamen inner join tdocentemateria on texamen.coddocentemateria = tdocentemateria.coddocentemateria inner join tmateria on tdocentemateria.codmateria = tmateria.codmateria where texamen.codexamen = :codexamen',['codexamen' => $codexamen]);
      $todas = DB::select('select p.valor,p.codpregunta,p.pregunta,p.tipo,p.imagen from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta where ep.codexamen = :codexamen',['codexamen' => $codexamen]);
      $p_unir = DB::select('select p.codpregunta,l.enunciado,r.respuesta,l.codlista from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta inner join tlistapregunta as lp on p.codpregunta = lp.codpregunta inner join tlista as l on l.codlista = lp.codlista inner join trespuesta as r on r.codrespuesta = l.codrespuesta where ep.codexamen = :codexamen and p.tipo = :tipo',['codexamen' => $codexamen,'tipo'=>'UNIR']);
      $p_completar = DB::select('select pa.cadena, pa.tipo, pa.codparte,p.codpregunta,pa.numero from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta inner join tpartes as pa on pa.codpregunta = p.codpregunta where ep.codexamen = :codexamen and p.tipo = :tipo order by p.codpregunta, pa.numero asc',['codexamen' => $codexamen,'tipo'=>'COMPLETAR']);
      $p_multiple = DB::select('select p.codpregunta,r.respuesta,r.codrespuesta,r.correcta from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta inner join tpreguntarespuesta as pr on p.codpregunta = pr.codpregunta inner join trespuesta as r on r.codrespuesta = pr.codrespuesta where ep.codexamen = :codexamen and p.tipo = :tipo',['codexamen' => $codexamen,'tipo'=>'SELECCION MULTIPLE']);
      $p_simple = DB::select('select p.codpregunta,r.respuesta,r.codrespuesta,r.correcta from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta inner join tpreguntarespuesta as pr on p.codpregunta = pr.codpregunta inner join trespuesta as r on r.codrespuesta = pr.codrespuesta where ep.codexamen = :codexamen and p.tipo = :tipo',['codexamen' => $codexamen,'tipo'=>'SELECCION SIMPLE']);
      $p_vf = DB::select('select p.codpregunta,r.respuesta,r.codrespuesta,r.correcta from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta inner join tpreguntarespuesta as pr on p.codpregunta = pr.codpregunta inner join trespuesta as r on r.codrespuesta = pr.codrespuesta where ep.codexamen = :codexamen and p.tipo = :tipo',['codexamen' => $codexamen,'tipo'=>'VERDADERO FALSO']);

      $user=DB::selectOne('select codestudianteparalelo from testudianteparalelo where codestudiante = :codestudiante',['codestudiante' => $codpersona]);
      $ce = $user->codestudianteparalelo;
      $r_estudiante = DB::select('select * from testudianterespuesta where codexamen = :codexamen and codestudiante = :codestudiante',['codexamen' => $codexamen,'codestudiante'=>$ce]);
      $nota = DB::selectOne('select nota from tnotafinal where codestudianteparalelo = :codestudianteparalelo and codexamen = :codexamen',['codestudianteparalelo'=>$ce,'codexamen' => $codexamen]);
      return view('student.examen.reporte1',["examen"=>$examen,"todas"=>$todas,"p_unir"=>$p_unir,"p_completar"=>$p_completar,"p_multiple"=>$p_multiple,"p_simple"=>$p_simple,"p_vf"=>$p_vf,"r_estudiante"=>$r_estudiante,'nota'=>$nota]);
    }
}
