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
                                <li  class="col-lg-12" iddm='{{$materia->coddocentemateria}}' nom='{{$materia->nommateria}}'><a href="#" id="materia"><i class="fa fa-bookmark"></i>   {{$materia->nommateria}}</a></li>
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
      <!-- Modal -->
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">INGRESAR CONTRASEÑA</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cerrar">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <form method="POST" id="contrasenia_evaluacion">
                    @csrf
                      <div class="modal-body">
                          <div class="form-group">
                            <p style="color:red" id="confirmacion_contrasenia"></p>
                            <input type="hidden" id="codexamen" name="codexamen" value="">
                            <input type="password" class="form-control" id="contrasenia" name="contrasenia" placeholder="Contraseña">
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                          <button type="submit" class="btn btn-primary" id="enviarexamen">Enviar</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
      <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle2" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle2">SISTEMA DE EVALUACIONES</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cerrar2">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <p id="confirmacion_contrasenia2">Esta evaluación ya no está disponible</p>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  </div>
              </div>
          </div>
      </div>
  </div>                        <!-- Button trigger modal -->
</main>
@endsection
