<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seguridad\Users; //Modelo
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\UserFormRequest;
use DB;

class AdminController extends Controller
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
        		return view('admin.profile.index',["users"=>$users]);
        }
    }
    public function getprofile(Request $request)
    {
        $id=$request->get('codpersona');
        $user = DB::selectOne('select * from tdatosexamen where codpersona = :codpersona',['codpersona'=>$id]);
        return view('admin.profile.edit',['user' => $user]);
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
      return Redirect::to('admin/profile');
        //return view('teacher.profile.index');
    }
}
