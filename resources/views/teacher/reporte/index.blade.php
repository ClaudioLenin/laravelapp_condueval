@extends ('layouts.teacher')
@section ('content_3')
<div class="accordion container-fluid p-y-md estructura color-estructura">
  <div class="card">
      <div id="collapsible-panels">
          <div class="card-header">
              <a href="#" id="reporte1"><h4>EVALUACIONES POR MATERIAS</h4></a>
          </div>
          <div class="card-body" id="contenido-1">
            <!--Contenido-->
            <div class="col-lg-12 p-4">
                <div class="col-lg-12" style="text-align: center;">
                    <label>SELECCIONAR</label>
                    <hr>
                </div>
                <div class="col-lg-6">
                    <p>Periodo</p>
                    <select id="periodo1" name="periodo1" class="form-control" disabled>
                      <option value="{{session('codperiodo')}}" selected>{{session('nomperiodo')}}</option>
                    </select>
                </div>
                <div class="col-lg-6">
                    <p>Sección</p>
                    <select id="seccion1" name="seccion" class="form-control">
                    </select>
                </div>
                <div class="col-lg-6">
                    <p>Paralelo</p>
                    <select id="paralelo1" name="paralelo" class="form-control">
                    </select>
                </div>
                <div class="col-lg-6">
                    <p>Materia</p>
                    <select id="materia1" name="materia" class="form-control">
                    </select>
                </div>
            </div>
            <!--Fin Contenido-->
            <div class="col-sm-12 p-4">
                <div style="padding-left: 10px;padding-right: 10px;padding-top: 20px" id="docente1">

                </div>
            </div>
            <div class="col-sm-12 p-4 table-responsive" id="contenido_1">
              <table class="table table-bordered">
                <thead style="text-align: center;background-color: #000;color: #FFF;text-transform: uppercase">
                    <tr>
                        <th scope="col">Nombre Evaluación</th>
                        <th scope="col">Fecha Evaluación</th>
                        <th scope="col">Número Estudiantes</th>
                        <th scope="col">Promedio Evaluación</th>
                        <th scope="col">Evaluación</th>
                        <th scope="col">Solucionario</th>
                    </tr>
                </thead>
                <tbody id="container1" style="text-align: center">
                </tbody>
              </table>
            </div>
          </div>
      </div>
  </div>
  <div class="card">
      <div id="collapsible-panels">
          <div class="card-header">
              <a href="#"><h4 class="x">LISTADO GENERAL DE EVALUACIONES</h4></a>
          </div>
          <div class="card-body" id="contenido-2">
            <!--Contenido-->
            <div class="col-lg-12 p-4">
                <div class="col-lg-12" style="text-align: center;">
                    <label>SELECCIONAR</label>
                    <hr>
                </div>
                <div class="col-lg-6">
                    <p>Periodo</p>
                    <select id="periodo2" name="periodo1" class="form-control" disabled>
                      <option value="{{session('codperiodo')}}" selected>{{session('nomperiodo')}}</option>
                    </select>
                </div>
                <div class="col-lg-6">
                    <p>Sección</p>
                    <select id="seccion2" name="seccion" class="form-control">
                    </select>
                </div>
                <div class="col-lg-6">
                    <p>Paralelo</p>
                    <select id="paralelo2" name="paralelo" class="form-control">
                    </select>
                </div>
            </div>
            <!--Fin Contenido-->
            <div class="col-sm-12 p-4 table-responsive" id="contenido_2">
              <table class="table table-bordered p-4 text-center">
                  <thead style="text-align: center;background-color: #000;color: #FFF;text-transform: uppercase">
                      <tr>
                          <th scope="col">Materia</th>
                          <th scope="col">Docente</th>
                          <th scope="col">Numero Evaluaciones</th>
                      </tr>
                  </thead>
                  <tbody id="container2" style="text-align: center">

                  </tbody>
              </table>
              <div class="col-lg-12 descarga p-4 text-right">
                  <form method="get" action="{{route('reporte_evaluaciones')}}" target="_blank">
                      <input type="hidden" id="codperiodo" name="codperiodo" value="">
                      <input type="hidden" id="codperiodoseccion" name="codperiodoseccion" value="">
                      <input type="hidden" id="codperiodoseccionparalelo" name="codperiodoseccionparalelo" value="">
                      <input class="btn btn-danger" type="submit" value="Imprimir" id="Imprimir">
                  </form>
              </div>
            </div>
          </div>
      </div>
  </div>
  <div class="card">
      <div id="collapsible-panels">
          <div class="card-header">
              <a href="#"><h4 class="x">LISTADO DETALLADO DE EVALUACIONES POR MATERIA</h4></a>
          </div>
          <div class="card-body" id="contenido-3">
            <div class="col-lg-12 p-4">
                <div class="col-lg-12" style="text-align: center;">
                    <label>SELECCIONAR</label>
                    <hr>
                </div>
                <div class="col-lg-6">
                    <p>Periodo</p>
                    <select id="periodo3" name="periodo3" class="form-control" disabled>
                      <option value="{{session('codperiodo')}}" selected>{{session('nomperiodo')}}</option>
                    </select>
                </div>
                <div class="col-lg-6">
                    <p>Sección</p>
                    <select id="seccion3" name="seccion" class="form-control">
                    </select>
                </div>
                <div class="col-lg-6">
                    <p>Paralelo</p>
                    <select id="paralelo3" name="paralelo" class="form-control">
                    </select>
                </div>
                <div class="col-lg-6">
                    <p>Materia</p>
                    <select id="materia3" name="materia" class="form-control">
                    </select>
                </div>
            </div>
            <div class="col-sm-12 p-4 table-responsive" id="contenido_3">
              <div class="col-sm-12 p-4">
                  <div style="padding-left: 10px;padding-right: 10px;padding-top: 20px" id="docente3">

                  </div>
              </div>
                <table class="table table-bordered p-4 text-center">
                    <thead style="text-align: center;background-color: #000;color: #FFF;text-transform: uppercase">
                        <tr>
                            <th scope="col">Nombre Evaluación</th>
                            <th scope="col">Fecha Evaluación</th>
                            <th scope="col">Número Estudiantes</th>
                            <th scope="col">Promedio Evaluación</th>
                        </tr>
                    </thead>
                    <tbody id="container3" style="text-align: center">
                    </tbody>
                </table>
                <div class="col-lg-12 descarga p-4 text-right">
                    <form method="get" action="{{route('reporte_estudiantes')}}" target="_blank">
                        <input type="hidden" id="codperiodo3" name="codperiodo3" value="">
                        <input type="hidden" id="codperiodoseccion3" name="codperiodoseccion3" value="">
                        <input type="hidden" id="codperiodoseccionparalelo3" name="codperiodoseccionparalelo3" value="">
                        <input type="hidden" id="coddocentemateria3" name="coddocentemateria3" value="">
                        <input class="btn btn-danger" type="submit" value="Imprimir" id="Imprimir">
                    </form>
                </div>
              </div>
          </div>
      </div>
  </div>

  <div class="card">
      <div id="collapsible-panels">
          <div class="card-header">
              <a href="#"><h4 class="x">EVALUACI&Oacute;N DE ESTUDIANTES POR MATERIA</h4></a>
          </div>
          <div class="card-body" id="contenido-4">
            <div class="col-lg-12 p-4">
                <div class="col-lg-12" style="text-align: center;">
                    <label>SELECCIONAR</label>
                    <hr>
                </div>
                <div class="col-lg-6">
                    <p>Periodo</p>
                    <select id="periodo4" name="periodo4" class="form-control" disabled>
                      <option value="{{session('codperiodo')}}" selected>{{session('nomperiodo')}}</option>
                    </select>
                </div>
                <div class="col-lg-6">
                    <p>Sección</p>
                    <select id="seccion4" name="seccion" class="form-control">
                    </select>
                </div>
                <div class="col-lg-6">
                    <p>Paralelo</p>
                    <select id="paralelo4" name="paralelo" class="form-control">
                    </select>
                </div>
                <div class="col-lg-6">
                    <p>Materia</p>
                    <select id="materia4" name="materia" class="form-control">
                    </select>
                </div>
                <div class="col-lg-12">
                    <p>Evaluaciones</p>
                    <select id="evaluacion4" name="evaluacion4" class="form-control">
                    </select>
                </div>
            </div>
            <div class="col-sm-12 p-4">
                <div style="padding-left: 10px;padding-right: 10px;padding-top: 20px" id="docente4">

                </div>
            </div>
            <div class="col-sm-12 p-4 table-responsive text-center" id="contenido_4">
                <table class="table table-bordered p-4 text-center">
                    <thead style="text-align: center;background-color: #000;color: #FFF;text-transform: uppercase">
                        <tr>
                            <th scope="col">Nombre Estudiante</th>
                            <th scope="col">Nota Evaluación</th>
                            <th scope="col">PDF Evaluación</th>
                        </tr>
                    </thead>
                    <tbody id="container4" style="text-align: center">
                    </tbody>
                </table>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
