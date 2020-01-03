<?php

namespace App\Http\Middleware;

use Closure;

class PermisoEstudiante
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next)
     {
       if($this->permiso())
         return $next($request);
       return redirect('/');//->('mensaje','No tienes permiso para estar aqui');
     }
     private function permiso(){
       return session()->get('tippersona') == 'Estudiante';
     }
}
