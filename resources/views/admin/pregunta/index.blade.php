@extends ('layouts.admin')
@section ('content')

<div class="row">

  <div class="col-lg-12">
      <!--Contenido-->
      <div class="col-lg-12 bloque">
          <div class="col-lg-12" style="text-align: center;">
              <label>SELECCIONAR</label>
              <hr>
          </div>
          <div class="col-lg-6">
              <p>Periodo</p>
              <select id="periodo" name="periodo" class="form-control">
              </select>
          </div>
          <div class="col-lg-6">
              <p>Sección</p>
              <select id="seccion" name="seccion" class="form-control">
              </select>
          </div>
          <div class="col-lg-6">
              <p>Paralelo</p>
              <select id="paralelo" name="paralelo" class="form-control">
              </select>
          </div>
          <div class="col-lg-6">
              <p>Materia</p>
              <select id="materia" name="materia" class="form-control">
              </select>
          </div>
      </div>
      <!--Fin Contenido-->
  </div>
</div>
<br>
<br>
<div class="row" id="ocultar_tabla_preguntas">
  <div class="col-lg-12">
    <div class="col-lg-12" style="text-align: center;">
        <label>LISTADO DE PREGUNTAS</label>
        <hr>
    </div>
    <div class="alert alert-secondary col-lg-12 text-center"  role="alert">
        <div class="col-lg-3 text-center" style="padding-top:15px;">
         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ingresar_pregunta">Ingresar Pregunta</button>
        </div>
        <form class="form-inline col-lg-9 my-2 my-log-0" method="post">
          <input type="hidden" id="coddocentemateria" name="coddocentemateria" value="">
          <div class="col-xs-11 text-right">
              <input id="search" style="width: 100%" class="form-control form-control-lg form-control-borderless" type="search" placeholder="Search topics or keywords">
          </div>
          <div class="col-xs-1 text-left">
              <i class="fa fa-search"></i>
          </div>
        </form>
    </div>
      <div id="listado_preguntas" class="col-lg-12 table-bordered table-hover table-striped table-responsive-sm table-responsive-md table-responsive table-responsive-lg table-responsive-xl" >
      </div>
  </div>
  </div>
@endsection
<!--MODAL DE INGRESO-->
@include('admin.pregunta.create')

<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Confirmation</h2>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
            </div>
            <div class="modal-footer">
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
