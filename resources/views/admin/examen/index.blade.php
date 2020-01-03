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
<div class="row" id="ocultar_tabla_preguntas">
  <div class="col-lg-12">
      <!--Contenido-->
      <div class="col-lg-12 bloque">
        <div class="col-lg-12" style="text-align: center;">
            <label>DATOS DE EVALUACIÓN</label>
            <hr>
        </div>
        <form method="POST" id="examen" enctype="multipart/form-data" onsubmit="return validaciones();">
          @csrf
          <input type="hidden" id="coddocentemateria" name="coddocentemateria" value="">
          <br>
          <div class="col-lg-4 col-md-4 col-xs-12">
            <div class="col-lg-12 col-md-12 col-xs-12">
              <p>Tipo de Exámen</p>
              <input type="text" class="form-control" id="nombre-examen" name="nombre-examen"  placeholder="EJ. PARCIAL, FINAL, GRADO, SUPLETORIO" required>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">
              <p>Contraseña</p>
              <input type="password" class="form-control" id="contrasenia" name="contrasenia" placeholder="Password" required>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">
              <p>Fecha y Hora de Inicio</p>
              <input type="datetime-local" class="form-control" name="fechaejecucion" placeholder="08/05/2019" required>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">
              <p>Fecha y Hora de Culminación</p>
              <input type="datetime-local" class="form-control" name="fechafin" placeholder="08/05/2019" required>
            </div>
            <br><br>
            <I><b>Nota:</b> El total de preguntas que seleccione debe dar una calificación de 20 puntos</I>
            <br><br>
          </div>
          <div class="col-lg-8 my-1">
            <p>Seleccionar Preguntas</p>
            <div style="overflow-x:auto;max-height: 50rem;">
              <table class="table table-striped table-responsive">
                <thead>
                  <th></th>
                  <th>PTS.</th>
                  <th>PREGUNTA</th>
                  <th>TIPO</th>
                </thead>
                <tbody id="listado2_preguntas">

                </tbody>
              </table>
            </div>
          </div>
          <div class="form-group col-lg-12">
              <div class="col-lg-12 text-center">
                  <button type="submit" class="btn btn-primary" name="Guardar" style="padding-right: 5px">Guardar</button>
                  <button type="reset" class="btn btn-danger " style="padding-left: 5px">Anular</button>
              </div>
          </div>
        </form>
      </div>
      <!--Fin Contenido-->
  </div>
  <div class="col-lg-12">
      <!--Contenido-->
      <div class="col-lg-12 bloque">
        <div class="col-lg-12" style="text-align: center;">
            <label>LISTADO DE EX&Aacute;MENES</label>
            <hr>
        </div>
        <div class="table table-striped table-responsive col-lg-12" id="examenes">
        </div>
      </div>
      <!--Fin Contenido-->
  </div>
</div>
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="confirm_examen">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
        <h4 class="modal-title">Evaluación Generada</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
			</div>
			<div class="modal-body">
				<p id="mensaje_examen"></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
			</div>
		</div>
	</div>
</div>
@endsection
