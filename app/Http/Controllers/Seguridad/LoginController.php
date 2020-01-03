<?php

namespace App\Http\Controllers\Seguridad;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;


class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/user';


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('seguridad.index');
    }
    public function username(){
        return 'cedula';
    }
    protected function authenticated(Request $request, $user)
    {
        $cedpersona = trim($request->cedula);
        $request->session()->put(['cedpersona' => $cedpersona]);
        if($cedpersona){
            $users = DB::select('select codpersona,nompersona,apepersona,cedpersona,tippersona from tpersona where cedpersona = :cedpersona', ['cedpersona' => $cedpersona]);

            foreach ($users as $user => $u) {
                $request->session()->put(['codpersona' => $u->codpersona]);
                $request->session()->put(['nompersona' => $u->nompersona]);
                $request->session()->put(['apepersona' => $u->apepersona]);
                $request->session()->put(['tippersona' => $u->tippersona]);
            }
            $data = DB::select('select *  from tdatosexamen where cedula = :cedula', ['cedula' => $cedpersona]);

            foreach ($data as $dat => $d) {
                $request->session()->put(['codusuarios' => $d->codusuarios]);
                $request->session()->put(['nombre' => $d->nombre]);
                $request->session()->put(['foto' => $d->foto]);
            }
            $periods = DB::select('select nomperiodo, codperiodo FROM tperiodo ORDER BY codperiodo desc limit 1');
            foreach ($periods as $period => $p) {
                $request->session()->put(['nomperiodo' => $p->nomperiodo]);
                $request->session()->put(['codperiodo' => $p->codperiodo]);
            }

        }
    }
}
