@extends ('layouts.student')
@section ('content')
<main class="app-layout-content">
  <div class="container-fluid p-y-md">
      <div class="row">
          <div class="container-fluid p-y-md estructura color-estructura">

              <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                      <div class="card-color-header" style="text-align: center;padding-top:20px">
                          ASIGNATURAS
                      </div>
                      <div class="card-body">
                          <nav class="drawer-main">
                              <ul class="nav nav-drawer">
                                @foreach($materias as $materia)
                                <li  class="col-lg-12" iddm='{{$materia->coddocentemateria}}' nom='{{$materia->nommateria}}'><a href="#" id="materia1"><i class="fa fa-bookmark"></i>   {{$materia->nommateria}}</a></li>
                        				@endforeach
                              </ul>
                          </nav>
                      </div>
                      {{$materias->render()}}
                  </div>
              </div>
              <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                      <div class="card-color-header" id="identificador-asignatura" style="text-align: center;padding-top:20px">
                          EVALUACIONES
                      </div>
                      <div class="card-body">
                          <nav class="drawer-main">
                              <ul class="nav nav-drawer" id="examenes">
                              </ul>
                          </nav>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>                        <!-- Button trigger modal -->
</main>
@endsection
