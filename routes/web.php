<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('seguridad/login','Seguridad\LoginController@index')->name('login');
Route::post('seguridad/login','Seguridad\LoginController@login')->name('login_post');
Route::get('seguridad/logout','Seguridad\LoginController@logout')->name('logout');

Route::get('user','User\UserController@index');
Route::group(['prefix' => 'admin','middleware' => ['auth','admin']],function(){
	Route::get('profile','Admin\AdminController@index')->name('profileadmin');
  Route::get('/getprofile','Admin\AdminController@getprofile')->name('getprofileadmin');
  Route::post('/editar','Admin\AdminController@actualizar')->name('editaradmin');

  Route::get('periodo','Periodo\PeriodoController@index')->name('periodo');
  Route::get('seccion','Seccion\SeccionController@index')->name('seccion');
  Route::get('paralelo','Paralelo\ParaleloController@index')->name('paralelo');
  Route::get('materia','Materia\MateriaController@index')->name('materia');

  //PREGUNTA
  Route::resource('pregunta','Pregunta\PreguntaController');
  Route::get('eliminarpregunta','Pregunta\PreguntaController@destroy');
  Route::post('modificarpregunta','Pregunta\PreguntaController@update')->name('modificarpregunta');
  Route::get('buscarpregunta','Pregunta\PreguntaController@buscarpregunta')->name('buscarpregunta');
  Route::get('listall/{page?}','Pregunta\PreguntaController@listall')->name('listall');
  Route::get('mostrarrespuesta','Respuesta\RespuestaController@mostrarrespuesta')->name('mostrarrespuesta');
  Route::post('guardarpregunta','Pregunta\PreguntaController@store')->name('guardarpregunta');
  //EXAMEN
  Route::resource('examen','Examen\ExamenController');
  Route::get('mostrarexamenes','Examen\ExamenController@mostrarexamenes')->name('mostrarexamenes'); //<-------mostrar examenes
  Route::get('mostrarpreguntasexamen','Examen\ExamenController@mostrarpreguntasexamen')->name('mostrarpreguntasexamen');
  Route::post('guardarexamen','Examen\ExamenController@guardarexamen')->name('guardarexamen');
  Route::get('eliminarexamen','Examen\ExamenController@eliminarexamen')->name('eliminarexamen');
  Route::get('modificarexamen','Examen\ExamenController@modificarexamen')->name('modificarexamen');

  //REPORTES
  Route::resource('reporte','Reporte\ReporteController');
  Route::get('reporte1','Reporte\ReporteController@reporte1');
  Route::get('docente','Reporte\ReporteController@docente');
  Route::get('evaluacion','Reporte\ReporteController@evaluacion');
  Route::get('solucionario','Reporte\ReporteController@solucionario');
  Route::get('reporte2','Reporte\ReporteController@reporte2');
  Route::get('reporte3','Reporte\ReporteController@reporte3');
  Route::get('reporte4','Reporte\ReporteController@reporte4');
  Route::get('reporte_evaluaciones2','Reporte\ReporteController@imprimirReporte2')->name('reporte_evaluaciones2');
  Route::get('reporte_estudiantes2','Reporte\ReporteController@imprimirReporte3')->name('reporte_estudiantes2');
  Route::get('evaluacion4','Evaluacion\EvaluacionController@index')->name('evaluacion4');
  Route::get('evaluacion_estudiante','Reporte\ReporteController@evaluacion_estudiante')->name('evaluacion_estudiante');

  //MATRICULA
  Route::get('matricula','Matricula\MatriculaController@index')->name('matricula');
  Route::post('registrar','Matricula\MatriculaController@registro_estudiante')->name('registrar');
  Route::post('registrar2','Matricula\MatriculaController@registro_docente')->name('registrar2');

});
Route::group(['prefix' => 'student','middleware' => ['auth','student']],function(){
	Route::get('profile','Student\StudentController@index')->name('profilestudent');
  Route::get('/getprofile','Student\StudentController@getprofile')->name('getprofilestudent');
  Route::post('/editar','Student\StudentController@actualizar')->name('editarstudent');

  //EXAMENES
  Route::get('evaluaciones','Student\StudentController@evaluaciones')->name('evaluaciones');
  Route::get('mostrarevaluaciones','Student\StudentController@mostrarevaluaciones')->name('mostrarevaluaciones');
  Route::post('verificarcontrasenia','Student\StudentController@verificarcontrasenia')->name('verificarcontrasenia');
  Route::get('comprobarexamen','Student\StudentController@comprobarexamen')->name('comprobarexamen');
  Route::get('traerexamen','Student\StudentController@traerexamen')->name('traerexamen');
  Route::post('guardarintento','Student\StudentController@store')->name('guardarintento');

  //REPORTES
  Route::get('reportes','Student\StudentController@reportes')->name('reportes');
  Route::get('mostrarreportes','Student\StudentController@mostrarreportes')->name('mostrarreportes');
  Route::get('reporte1','Student\Reporte1Controller@reporte1')->name('reporte1');
});
Route::group(['prefix' => 'teacher','middleware' => ['auth','teacher']],function(){
	Route::get('/profile','Teacher\TeacherController@index')->name('profileteacher');
  Route::get('/getprofile','Teacher\TeacherController@getprofile')->name('getprofile');
  Route::post('/editar','Teacher\TeacherController@actualizar')->name('editar');

  Route::get('seccion','Seccion\SeccionController@index')->name('seccion');
  Route::get('paralelo','Paralelo\ParaleloController@index')->name('paralelo');
  Route::get('materia','Materia\MateriaController@index2')->name('materias');
  //PREGUNTA
  Route::resource('pregunta','Pregunta\PreguntaController');
  Route::get('eliminarpregunta','Pregunta\PreguntaController@destroy');
  Route::post('modificarpregunta','Pregunta\PreguntaController@update')->name('modificarpregunta');
  Route::get('buscarpregunta','Pregunta\PreguntaController@buscarpregunta')->name('buscarpregunta');
  Route::get('listall/{page?}','Pregunta\PreguntaController@listall')->name('listall');
  Route::get('mostrarrespuesta','Respuesta\RespuestaController@mostrarrespuesta')->name('mostrarrespuesta');
  Route::post('guardarpregunta2','Pregunta\PreguntaController@store')->name('guardarpregunta2');

  //EXAMEN
  Route::resource('examen','Examen\ExamenController');
  Route::get('mostrarexamenes','Examen\ExamenController@mostrarexamenes')->name('mostrarexamenes'); //<-------mostrar examenes
  Route::get('mostrarpreguntasexamen','Examen\ExamenController@mostrarpreguntasexamen')->name('mostrarpreguntasexamen');
  Route::post('guardarexamen','Examen\ExamenController@guardarexamen')->name('guardarexamen');
  Route::get('eliminarexamen','Examen\ExamenController@eliminarexamen')->name('eliminarexamen');
  Route::get('modificarexamen','Examen\ExamenController@modificarexamen')->name('modificarexamen');

  //REPORTES
  Route::resource('reporte','Reporte\ReporteController');
  Route::get('reporte1','Reporte\ReporteController@reporte1');
  Route::get('docente','Reporte\ReporteController@docente');
  Route::get('evaluacion','Reporte\ReporteController@evaluacion');
  Route::get('solucionario','Reporte\ReporteController@solucionario');
  Route::get('reporte2','Reporte\ReporteController@reporte2');
  Route::get('reporte3','Reporte\ReporteController@reporte3');
  Route::get('reporte4','Reporte\ReporteController@reporte4');
  Route::get('reporte_evaluaciones','Reporte\ReporteController@imprimirReporte2')->name('reporte_evaluaciones');
  Route::get('reporte_estudiantes','Reporte\ReporteController@imprimirReporte3')->name('reporte_estudiantes');
  Route::get('evaluacion4','Evaluacion\EvaluacionController@index')->name('evaluacion4');
  Route::get('evaluacion_estudiante','Reporte\ReporteController@evaluacion_estudiante')->name('evaluacion_estudiante');
});
Route::resource('developer','Developer\DeveloperController');
