<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Seguridad\Users; //Modelo
use Illuminate\Support\Facades\Input;
use App\Models\EstudianteRespuesta; //Modelo
use App\Models\NotaFinal; //Modelo
use App\Models\Examen; //Modelo
use App\Models\ExamenPregunta; //Modelo
use DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if($request){
          $cedpersona = session()->get('cedpersona');
          $users = DB::table('tdatosexamen as d')->where('d.cedula','=',$cedpersona)
          ->paginate(1);
          return view('student.profile.index',["users"=>$users]);
      }
    }
    public function getprofile(Request $request)
    {
        $id=$request->get('codpersona');
        $user = DB::selectOne('select * from tdatosexamen where codpersona = :codpersona',['codpersona'=>$id]);
        return view('student.profile.edit',['user' => $user]);
    }

    public function actualizar(Request $request)
    {
      $codpersona = session()->get('codpersona');
      $user=DB::selectOne('select * from tdatosexamen as d where d.codpersona = :codpersona',['codpersona' => $codpersona]);
      $usuario=Users::findOrFail($user->codusuarios);
      $usuario->nombre = $request->post('nombre');
      $usuario->email = $request->post('email');
      $usuario->descripcion = $request->post('descripcion');
      if($request->file('foto')!=null){
        $file = $request->file('foto');
        $file->move(public_path().'/images/users/',$file->getClientOriginalName());
        $nombre = $file->getClientOriginalName();
        $usuario->foto = $nombre;
      }
      if( $request->post('password') != '0604838763'){
          $usuario->password = bcrypt($request->post('password'));
      }
      $usuario->update();
      return Redirect::to('student/profile');
        //return view('teacher.profile.index');
    }
    public function evaluaciones()
    {
      $codpersona = session()->get('codpersona');
      $user=DB::selectOne('select * from testudianteparalelo where codestudiante = :codestudiante',['codestudiante' => $codpersona]);
      $materias = DB::table('tmateria as m')
      ->join('tdocentemateria as d','m.codmateria','=','d.codmateria')
      ->join('tperiodoseccionparalelo as p','p.codperiodoseccionparalelo','=','d.codperiodoseccionparalelo')
      ->join('tperiodoseccion as pe','pe.codperiodoseccion','=','p.codperiodoseccion')
      ->join('tperiodo as per','per.codperiodo','=','pe.codperiodo')
      ->select('m.nommateria','d.coddocentemateria')
      ->where('per.codperiodo','=',$user->codperiodo)
      ->where('pe.codseccion','=',$user->codseccion)
      ->where('p.codparalelo','=',$user->codparalelo)
      ->orderBy('d.coddocentemateria','desc')
      ->paginate(20);
    		//return view('almacen.articulo.index',["articulos"=>$articulos,"searchText"=>$query]);*/
       return view('student.examen.index',["materias"=>$materias]);
       //return json_encode($materias);
    }
    public function mostrarevaluaciones(Request $request){
      $coddocentemateria = $request->get('iddm');
      $examenes = DB::select('select * from texamen where coddocentemateria = :coddocentemateria',['coddocentemateria' => $coddocentemateria]);
      date_default_timezone_set('Etc/GMT+5');
      $hoy = array();
      $hoy = date("Y-m-d H:i:00", time());
      foreach ($examenes as $examen) {
        if (strtotime($hoy) > strtotime($examen->fechafin) || strtotime($examen->fechaejecucion) > strtotime($examen->fechafin)) {
            $new_exam = Examen::findOrFail($examen->codexamen);
            $new_exam->estado = "DESHABILITADO";
        	  $new_exam->update();
        }
      }
      $examenes = DB::select('select * from texamen where coddocentemateria = :coddocentemateria and estado = :estado',['coddocentemateria' => $coddocentemateria,'estado'=>'HABILITADO']);
      return json_encode($examenes);
    }

    public function verificarcontrasenia(Request $request){
      date_default_timezone_set('Etc/GMT+5');
      $hoy = array();
      $hoy = date("Y-m-d H:i:00", time());

      $codexamen = $request->post('codexamen');
      $clave = $request->post('contrasenia');
      $examen=DB::selectOne('select * from texamen where codexamen = :codexamen and clave = :clave',['codexamen' => $codexamen,'clave' => $clave]);
      if($examen!=""){
        if (strtotime($hoy) < strtotime($examen->fechaejecucion)) {
          return "ko";
        }else if (strtotime($hoy) >= strtotime($examen->fechaejecucion) && strtotime($hoy) <= strtotime($examen->fechafin)) {
          return json_encode($examen);
        }
      }else {
        return "null";
      }
    }
    public function comprobarexamen(Request $request){
      $codpersona = session()->get('codpersona');
      $codexamen = $request->get('codexamen');
      $user=DB::selectOne('select codestudianteparalelo from testudianteparalelo where codestudiante = :codestudiante',['codestudiante' => $codpersona]);
      $codestudianteparalelo = $user->codestudianteparalelo;
      $examen_respuestas = DB::selectOne('select nota from tnotafinal where codexamen = :codexamen and codestudianteparalelo = :codestudianteparalelo',['codexamen' => $codexamen,'codestudianteparalelo' => $codestudianteparalelo]);
      return json_encode($examen_respuestas);
    }
    public function traerexamen(Request $request){
      $codexamen = $request->get('codexamen');
      $examen = DB::select('select texamen.descripcion,texamen.fechaejecucion,texamen.fechafin,texamen.fechacreacion, texamen.codexamen, texamen.estado, tmateria.nommateria from texamen inner join tdocentemateria on texamen.coddocentemateria = tdocentemateria.coddocentemateria inner join tmateria on tdocentemateria.codmateria = tmateria.codmateria where texamen.codexamen = :codexamen',['codexamen' => $codexamen]);
      $todas = DB::select('select p.valor,p.codpregunta,p.pregunta,p.tipo,p.imagen from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta where ep.codexamen = :codexamen ORDER BY RANDOM()',['codexamen' => $codexamen]);
      $p_unir_enunciado = DB::select('select p.codpregunta,l.enunciado,l.codlista from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta inner join tlistapregunta as lp on p.codpregunta = lp.codpregunta inner join tlista as l on l.codlista = lp.codlista inner join trespuesta as r on r.codrespuesta = l.codrespuesta where ep.codexamen = :codexamen and p.tipo = :tipo order by random()',['codexamen' => $codexamen,'tipo'=>'UNIR']);
      $p_unir_respuesta = DB::select('select p.codpregunta,r.respuesta,r.codrespuesta from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta inner join tlistapregunta as lp on p.codpregunta = lp.codpregunta inner join tlista as l on l.codlista = lp.codlista inner join trespuesta as r on r.codrespuesta = l.codrespuesta where ep.codexamen = :codexamen and p.tipo = :tipo order by random()',['codexamen' => $codexamen,'tipo'=>'UNIR']);
      $p_completar = DB::select('select pa.cadena, pa.tipo, pa.codparte,p.codpregunta from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta inner join tpartes as pa on pa.codpregunta = p.codpregunta where ep.codexamen = :codexamen and p.tipo = :tipo order by p.codpregunta, pa.numero asc',['codexamen' => $codexamen,'tipo'=>'COMPLETAR']);
      $p_multiple = DB::select('select p.codpregunta,r.respuesta,r.codrespuesta,r.correcta from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta inner join tpreguntarespuesta as pr on p.codpregunta = pr.codpregunta inner join trespuesta as r on r.codrespuesta = pr.codrespuesta where ep.codexamen = :codexamen and p.tipo = :tipo order by random()',['codexamen' => $codexamen,'tipo'=>'SELECCION MULTIPLE']);
      $p_simple = DB::select('select p.codpregunta,r.respuesta,r.codrespuesta,r.correcta from tpregunta as p inner join texamenpregunta as ep on p.codpregunta = ep.codpregunta inner join tpreguntarespuesta as pr on p.codpregunta = pr.codpregunta inner join trespuesta as r on r.codrespuesta = pr.codrespuesta where ep.codexamen = :codexamen and p.tipo = :tipo order by random()',['codexamen' => $codexamen,'tipo'=>'SELECCION SIMPLE']);
      return view('student.examen.examen',["examen"=>$examen,"todas"=>$todas,"p_unir_enunciado"=>$p_unir_enunciado,"p_unir_respuesta"=>$p_unir_respuesta,"p_completar"=>$p_completar,"p_multiple"=>$p_multiple,"p_simple"=>$p_simple]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //GUARDAR Y CALIFICAR AL ESTUDIANTE

    public function store(Request $request)
    {
      $codpersona = session()->get('codpersona');
      $user=DB::selectOne('select codestudianteparalelo from testudianteparalelo where codestudiante = :codestudiante',['codestudiante' => $codpersona]);
      $codexamen = $request->post('codexamen');
      $ep = $user->codestudianteparalelo;
      $verificarnota=DB::selectOne('select * from tnotafinal where codexamen = :codexamen and codestudianteparalelo = :codestudianteparalelo',['codexamen' => $codexamen,'codestudianteparalelo'=>$ep]);

      if(!isset($verificarnota->codestudianteparalelo) && !isset($verificarnota->codexamen)){
        $examen = DB::select('select p.tipo,p.codpregunta,p.valor from tpregunta as p inner join texamenpregunta as e on p.codpregunta = e.codpregunta where e.codexamen = :codexamen',['codexamen' => $codexamen]);
        $notafinal = 0; //nota final de evaluacion
        foreach ($examen as $pregunta) {
          $notaparcial = 0; //nota parcial de pregunta
          $notaparcial = 0; //nota parcial de pregunta
          $cp = $pregunta->codpregunta; //codigo de la pregunta
          $total_opciones = 0; //total de opciones correctas en la pregunta
          $opciones_bien = 0; //total de opciones correctas
          $opciones_mal = 0; //total de opciones incorrectas
          switch ($pregunta->tipo ) {
            case 'UNIR':
              $r_unir = DB::select('select l.codlista,r.respuesta,l.enunciado from trespuesta as r inner join tlista as l on r.codrespuesta = l.codrespuesta inner join tlistapregunta as lp on l.codlista = lp.codlista where lp.codpregunta = :codpregunta',['codpregunta' => $cp]);
              foreach ($r_unir as $unir) {
                $total_opciones++;
                if(($request->post('unir'.$unir->codlista)) == ($unir->respuesta)){
                  $opciones_bien++;
                }else{
                  $opciones_mal++;
                }
              }
              $notaparcial = round((($pregunta->valor / $total_opciones) * $opciones_bien),2);
              if($notaparcial >= 0){
                $notafinal += $notaparcial; //suma nota final UNIR
              }
              foreach ($r_unir as $unir) {
                $er = new EstudianteRespuesta;
                $er->pregunta = $unir->enunciado;
                $er->respuesta = $request->post('unir'.$unir->codlista);
                if($notaparcial <= 0){
                  $er->valor = 0;
                }else {
                  $er->valor = $notaparcial;
                }
                $er->codpregunta = $cp;
                $er->codexamen = $codexamen;
                $er->codestudiante = $user->codestudianteparalelo;
                $er->save();
              }
              break;
            case 'COMPLETAR':
                $r_completar = DB::select('select pa.cadena,pa.codparte,pa.numero,pa.tipo from tpregunta as p inner join tpartes as pa on p.codpregunta = pa.codpregunta where p.codpregunta = :codpregunta order by numero asc',['codpregunta' => $cp]);
                foreach ($r_completar as $completar) {
                  if($completar->tipo == 'COMPLETAR'){
                      $total_opciones++;
                  }
                  if(trim(strtolower($request->post('completar'.$completar->codparte))) == trim(strtolower($completar->cadena))){
                    if($completar->tipo == 'COMPLETAR'){
                        $opciones_bien++;
                    }
                  }else{
                    if($completar->tipo == 'COMPLETAR'){
                      $opciones_mal++;
                    }
                  }
                }
                $notaparcial = round((($pregunta->valor / $total_opciones) * $opciones_bien),2);
                if($notaparcial >= 0){
                  $notafinal += $notaparcial; //suma nota final COMPLETAR
                }
                foreach ($r_completar as $completar) {
                  if($completar->tipo == 'COMPLETAR'){
                    $er = new EstudianteRespuesta;
                    $er->respuesta = $request->post('completar'.$completar->codparte);
                    if($notaparcial <= 0){
                      $er->valor = 0;
                    }else {
                      $er->valor = $notaparcial;
                    }
                    $er->codpregunta = $cp;
                    $er->codexamen = $codexamen;
                    $er->numero = $completar->numero;
                    $er->codestudiante = $user->codestudianteparalelo;
                    $er->save();
                  }
                }
              break;
            case 'SELECCION MULTIPLE':
                $r_multiple = DB::select('select r.codrespuesta,r.respuesta,r.correcta from tpreguntarespuesta as pr inner join trespuesta as r on pr.codrespuesta = r.codrespuesta where pr.codpregunta = :codpregunta',['codpregunta' => $cp]);
                foreach ($r_multiple as $multiple) {
                  if($multiple->correcta == 'SI'){
                    $total_opciones++;
                  }
                  if(trim($request->post('smultiple'.$multiple->codrespuesta)) == trim($multiple->respuesta)){
                    if($multiple->correcta == 'SI'){
                      $opciones_bien++;
                    }else {
                      $opciones_mal++;
                    }
                  }
                }
                $notaparcial = round((($pregunta->valor / $total_opciones) * ($opciones_bien-$opciones_mal)),2);
                if($notaparcial >= 0){
                  $notafinal += $notaparcial; //suma nota final SMULTIPLE
                }
                foreach ($r_multiple as $multiple) {
                  if($request->post('smultiple'.$multiple->codrespuesta)!=""){
                    $er = new EstudianteRespuesta;
                    $er->respuesta = $request->post('smultiple'.$multiple->codrespuesta);
                    if($notaparcial <= 0){
                      $er->valor = 0;
                    }else {
                      $er->valor = $notaparcial;
                    }
                    $er->codpregunta = $cp;
                    $er->codexamen = $codexamen;
                    $er->codestudiante = $user->codestudianteparalelo;
                    $er->save();
                  }
                }
              break;
            case 'SELECCION SIMPLE':
                $r_simple = DB::select('select r.codrespuesta,r.respuesta,r.correcta from tpreguntarespuesta as pr inner join trespuesta as r on pr.codrespuesta = r.codrespuesta where pr.codpregunta = :codpregunta and r.correcta = :correcta',['codpregunta' => $cp,'correcta'=>'SI']);
                foreach ($r_simple as $simple) {
                  if(trim($request->post('ssimple'.$cp)) == trim($simple->respuesta)){
                    if($simple->correcta == 'SI'){
                      $opciones_bien++;
                    }else {
                      $opciones_mal++;
                    }
                  }
                }
                if($opciones_bien == 1){
                  $notafinal += $pregunta->valor; //suma nota final SSIMPLE
                }
                foreach ($r_simple as $simple) {
                  if($request->post('ssimple'.$cp)!=""){
                    $er = new EstudianteRespuesta;
                    $er->respuesta = $request->post('ssimple'.$cp);
                    if($opciones_bien == 1){
                      $er->valor = $pregunta->valor;
                    }else {
                      $er->valor = 0;
                    }
                    $er->codpregunta = $cp;
                    $er->codexamen = $codexamen;
                    $er->codestudiante = $user->codestudianteparalelo;
                    $er->save();
                  }
                }
              break;
            case 'VERDADERO FALSO':
                $r_vf = DB::select('select r.codrespuesta,r.respuesta,r.correcta from tpreguntarespuesta as pr inner join trespuesta as r on pr.codrespuesta = r.codrespuesta where pr.codpregunta = :codpregunta and r.correcta = :correcta',['codpregunta' => $cp,'correcta'=>'SI']);
                foreach ($r_vf as $vf) {
                  if(trim($request->post('vf'.$cp)) == trim($vf->respuesta)){
                    if($vf->correcta == 'SI'){
                      $opciones_bien++;
                    }else {
                      $opciones_mal++;
                    }
                  }
                }
                if($opciones_bien == 1){
                  $notafinal += $pregunta->valor; //suma nota final VF
                }
                foreach ($r_vf as $vf) {
                  if($request->post('vf'.$cp)!=""){
                    $er = new EstudianteRespuesta;
                    $er->respuesta = $request->post('vf'.$cp);
                    if($opciones_bien == 1){
                      $er->valor = $pregunta->valor;
                    }else {
                      $er->valor = 0;
                    }
                    $er->codpregunta = $cp;
                    $er->codexamen = $codexamen;
                    $er->codestudiante = $user->codestudianteparalelo;
                    $er->save();
                  }
                }
              break;
            default:
              break;
          }
        }
        //DB::insert('insert into users (id, name) values (?, ?)', [1, 'Dayle']);

        DB::table('tnotafinal')->insert(['codexamen' => $codexamen, 'codestudianteparalelo' => $ep,'nota'=>$notafinal]);
      }
      return Redirect::to('student/evaluaciones');


    //  return   $notaparcial; //nota parcial de pregunta;
     //return dd($request->post());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    public function reportes(){
      $codpersona = session()->get('codpersona');
      $user=DB::selectOne('select * from testudianteparalelo where codestudiante = :codestudiante',['codestudiante' => $codpersona]);
      $materias = DB::table('tmateria as m')
      ->join('tdocentemateria as d','m.codmateria','=','d.codmateria')
      ->join('tperiodoseccionparalelo as p','p.codperiodoseccionparalelo','=','d.codperiodoseccionparalelo')
      ->join('tperiodoseccion as pe','pe.codperiodoseccion','=','p.codperiodoseccion')
      ->join('tperiodo as per','per.codperiodo','=','pe.codperiodo')
      ->select('m.nommateria','d.coddocentemateria')
      ->where('per.codperiodo','=',$user->codperiodo)
      ->where('pe.codseccion','=',$user->codseccion)
      ->where('p.codparalelo','=',$user->codparalelo)
      ->orderBy('d.coddocentemateria','desc')
      ->paginate(20);
        //return view('almacen.articulo.index',["articulos"=>$articulos,"searchText"=>$query]);*/
       return view('student.examen.reporte',["materias"=>$materias]);
    }
    public function mostrarreportes(Request $request){
      $codpersona = session()->get('codpersona');
      $user=DB::selectOne('select codestudianteparalelo from testudianteparalelo where codestudiante = :codestudiante',['codestudiante' => $codpersona]);
      $codestudianteparalelo = $user->codestudianteparalelo;
      $coddocentemateria = $request->get('iddm');
      $examenes = DB::select('select * from texamen as e inner join tnotafinal as n on e.codexamen = n.codexamen where coddocentemateria = :coddocentemateria and n.codestudianteparalelo = :codestudianteparalelo',['coddocentemateria' => $coddocentemateria,'codestudianteparalelo'=>$codestudianteparalelo]);
      date_default_timezone_set('Etc/GMT+5');
      $hoy = array();
      $hoy = date("Y-m-d H:i:00", time());
      foreach ($examenes as $examen) {
        if (strtotime($hoy) > strtotime($examen->fechafin) || strtotime($examen->fechaejecucion) > strtotime($examen->fechafin)) {
            $new_exam = Examen::findOrFail($examen->codexamen);
            $new_exam->estado = "DESHABILITADO";
        	  $new_exam->update();
        }
      }
      $examenes = DB::select('select * from texamen as e inner join tnotafinal as n on e.codexamen = n.codexamen where coddocentemateria = :coddocentemateria and estado = :estado and n.codestudianteparalelo = :codestudianteparalelo',['coddocentemateria' => $coddocentemateria,'estado'=>'DESHABILITADO','codestudianteparalelo'=>$codestudianteparalelo]);
      return json_encode($examenes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
