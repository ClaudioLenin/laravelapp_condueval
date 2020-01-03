@extends ('layouts.plantilla')
@section ('content_2')
<div class="row">
  <div class="col-md-12">
    <div class="box">
        <div class="box-header with-border">
        <div class="box-body">
          <div class="text-center col-lg-12">
            <span class="logo-mini"><img src="{{asset('img/conduespoch_sinletras.png')}}" width="40" height="40"></span>
          </div>
          <div class="text-center col-lg-12">
            <h3>ESCUELA DE CONDUCCION PROFESIONAL CONDUESPOCH E.P.</h3>
            <h4>LISTADO DE EVALUACIONES</h4>
          </div>
              <div class="table-responsive col-lg-12 col-sm-12 col-md-12 col-xs-12 rounded-lg p-5" style="margin-bottom:20px">
                <table class="table">
                  <tbody>
                      <tr>
                        @foreach ($periodo as $per)
                          <td><b>Periodo: </b>{{$per->nomperiodo}}</td>
                        @endforeach
                      </tr>
                      <tr>
                        @foreach ($seccion as $sec)
                          <td><b>Sección: </b>{{$sec->nomseccion}}</td>
                        @endforeach
                      </tr>
                      <tr>
                        @foreach ($paralelo as $par)
                          <td><b>Paralelo: </b>{{$par->codparalelo}}</td>
                        @endforeach
                      </tr>
                      <tr>
                        @foreach ($materias as $mat)
                          <td><b>Materia: </b>{{$mat->nommateria}}</td>
                        @endforeach
                      </tr>
                      <tr>
                        @foreach ($materias as $mat)
                          <td><b>Docente: </b>{{$mat->nompersona}} {{$mat->apepersona}}</td>
                        @endforeach
                      </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-sm-12 p-4 table-responsive" id="contenido_2">
                <div class="col-lg-11">
                  <table class="table table-bordered p-4 text-center">
                      <thead style="text-align: center;background-color: #000;color: #FFF;text-transform: uppercase">
                          <tr>
                              <th scope="col">Nombre Evaluación</th>
                              <th scope="col">Fecha Ejecución</th>
                              <th scope="col">Cantidad Estudiantes</th>
                              <th scope="col">Promedio</th>
                          </tr>
                      </thead>
                      <tbody id="container3" style="text-align: center">
                          @foreach ($evaluaciones as $evaluacion)
                          <tr>
                            <td>{{$evaluacion->descripcion}}</td>
                            <td>{{$evaluacion->fechaejecucion}}</td>
                            <td>
                              @foreach ($cantidad as $c => $x)
                                @if($evaluacion->codexamen == $c)
                                  {{$x}}
                                @endif
                              @endforeach
                            </td>
                            <td>
                              @foreach ($promedio as $c => $x)
                                @if($evaluacion->codexamen == $c)
                                  {{$x}}
                                @endif
                              @endforeach
                            </td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
                </div>
              </div>
            <div class="box-body">

          </div>
          </div>
        </div><!-- /.row -->
      </div>

            </div>
          </div><!-- /.row -->
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div><!-- /.col -->
</div><!-- /.row -->
@endsection
