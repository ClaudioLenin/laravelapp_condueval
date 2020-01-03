<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;

class UserController extends Controller
{
    /**s
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function __construct(){
        $this->middleware('auth');
    }*/
    public function index()
    {
        $tippersona = session()->get('tippersona');
        if ($tippersona == 'Administrativo') {
            return Redirect::to('/admin/profile');
        }else if ($tippersona == 'Estudiante') {
            return Redirect::to('/student/profile');
        }else if ($tippersona == 'Docente') {
            return Redirect::to('/teacher/profile');
        }else{
            return Redirect::to('/seguridad/logout');
        }
        //session()->put(['tipo' => $dd]);
        //dd(session()->all());

        //return view('admin.index');
    }

}
