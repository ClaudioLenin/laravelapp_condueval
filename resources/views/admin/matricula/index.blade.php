@extends('layouts.admin')
@section('content')
<div class="accordion container-fluid p-y-md estructura color-estructura">
  <div class="card">
      <div id="collapsible-panels">
          <div class="card-header">
              <a href="#" id="reporte1"><h4>REGISTRAR ESTUDIANTES</h4></a>
          </div>
          <div class="card-body" id="contenido-1">
            <!--Contenido-->
            <form action="{{route('registrar')}}" method="post">
                @csrf
              <div class="col-sm-12 p-4 table-responsive" id="contenido_1x">
                <table class="table table-bordered text-center">
                  <thead style="text-align: center;background-color: #000;color: #FFF;text-transform: uppercase">
                      <tr>
                          <th scope="col"><button class="btn btn-info" type="button" id="todo" name="todo">Marcar</button></th>
                          <th scope="col">cédula</th>
                          <th scope="col">Nombres y Apellidos</th>
                          <th scope="col">Email</th>
                      </tr>
                  </thead>

                    <tbody id="container1x" style="text-align: center">
                      @foreach ($todos as $estudiante)
                        <tr>
                          <td><input class="estilo-check" type="checkbox" name="estudiantes[]" value='{{$estudiante->codpersona}}'></td>
                          <td>{{$estudiante->cedpersona}}</td>
                          <td>{{$estudiante->nompersona}} {{$estudiante->apepersona}}</td>
                          <td>{{$estudiante->corpersona}}</td>
                        </tr>
                      @endforeach
                    </tbody>

                </table>
              </div>
              <div class="col-lg-12 text-right p-4">
                <input class="btn btn-warning" type="submit" name="Registrar" value="Registrar">
              </div>
            </form>
            <!--Fin Contenido-->
          </div>
      </div>
  </div>
  <div class="card">
      <div id="collapsible-panels">
          <div class="card-header">
              <a href="#" id="reporte1"><h4>REGISTRAR DOCENTES</h4></a>
          </div>
          <div class="card-body" id="contenido-2">
            <!--Contenido-->
            <form action="{{route('registrar2')}}" method="post">
                @csrf
              <div class="col-sm-12 p-4 table-responsive" id="contenido_2x">
                <table class="table table-bordered text-center">
                  <thead style="text-align: center;background-color: #000;color: #FFF;text-transform: uppercase">
                      <tr>
                          <th scope="col"><button class="btn btn-info" type="button" id="todo2" name="todo2">Marcar</button></th>
                          <th scope="col">cédula</th>
                          <th scope="col">Nombres y Apellidos</th>
                          <th scope="col">Email</th>
                      </tr>
                  </thead>

                    <tbody id="container2x" style="text-align: center">
                      @foreach ($todos2 as $docente)
                        <tr>
                          <td><input class="estilo-check" type="checkbox" name="docentes[]" value='{{$docente->codpersona}}'></td>
                          <td>{{$docente->cedpersona}}</td>
                          <td>{{$docente->nompersona}} {{$docente->apepersona}}</td>
                          <td>{{$docente->corpersona}}</td>
                        </tr>
                      @endforeach
                    </tbody>

                </table>
              </div>
              <div class="col-lg-12 text-right p-4">
                <input class="btn btn-warning" type="submit" name="Registrar" value="Registrar">
              </div>
            </form>
            <!--Fin Contenido-->
          </div>
      </div>
  </div>
</div>
@endsection
