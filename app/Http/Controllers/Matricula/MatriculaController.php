<?php

namespace App\Http\Controllers\Matricula;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Seguridad\Users; //Modelo
use DB;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $estudiantes = DB::select('select codpersona,cedpersona from tpersona where tippersona = :tippersona except select codpersona,cedula from tdatosexamen order by codpersona desc',['tippersona' => 'Estudiante']);
      $docentes = DB::select('select codpersona,cedpersona from tpersona where tippersona = :tippersona except select codpersona,cedula from tdatosexamen order by codpersona desc',['tippersona' => 'Docente']);
      $todos = array();
      $todos2 = array();
      foreach ($estudiantes as $estudiante) {
        $cedpersona = $estudiante->cedpersona;
        $codpersona = $estudiante->codpersona;
        $selec = DB::selectOne('select codpersona,cedpersona,nompersona,apepersona,corpersona from tpersona where codpersona = :codpersona and cedpersona = :cedpersona',['codpersona' => $codpersona, 'cedpersona' => $cedpersona]);
        array_push($todos, $selec);
      }
      foreach ($docentes as $docente) {
        $cedpersona = $docente->cedpersona;
        $codpersona = $docente->codpersona;
        $selec = DB::selectOne('select codpersona,cedpersona,nompersona,apepersona,corpersona from tpersona where codpersona = :codpersona and cedpersona = :cedpersona',['codpersona' => $codpersona, 'cedpersona' => $cedpersona]);
        array_push($todos2, $selec);
      }
      return view('admin.matricula.index',["todos"=>$todos,"todos2"=>$todos2]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registro_estudiante(Request $request)
    {
      $estudiantes = $request->post('estudiantes');
      if($estudiantes != ""){
        foreach ($estudiantes as $estudiante) { //recorre el vector de las preguntas seleccionadas
          $student = DB::selectOne('select codpersona,cedpersona,nompersona,apepersona,corpersona from tpersona where codpersona = :codpersona',['codpersona' => $estudiante]);
          $usuario = new Users;
          $usuario->cedula = $student->cedpersona;
          $usuario->nombre = $student->nompersona." ".$student->apepersona;
          $usuario->foto = 'default.png';
          $usuario->password = bcrypt($student->cedpersona);
          $usuario->codpersona = $student->codpersona;
          $usuario->email = $student->corpersona;
          $usuario->descripcion = "Estudiante";
          $usuario->save();
        }
      }
      return Redirect::to('admin/matricula');
    }
    public function registro_docente(Request $request){
      $docentes = $request->post('docentes');
      if($docentes != ""){
        foreach ($docentes as $docente) { //recorre el vector de las preguntas seleccionadas
          $teacher = DB::selectOne('select codpersona,cedpersona,nompersona,apepersona,corpersona from tpersona where codpersona = :codpersona',['codpersona' => $docente]);
          $usuario = new Users;
          $usuario->cedula = $teacher->cedpersona;
          $usuario->nombre = $teacher->nompersona." ".$teacher->apepersona;
          $usuario->foto = 'default.png';
          $usuario->password = bcrypt($teacher->cedpersona);
          $usuario->codpersona = $teacher->codpersona;
          $usuario->email = $teacher->corpersona;
          $usuario->descripcion = "Docente";
          $usuario->save();
        }
      }
      return Redirect::to('admin/matricula');
    }
}
