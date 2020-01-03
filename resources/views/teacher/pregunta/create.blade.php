<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="ingresar_pregunta">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
         <h4 class="modal-title">Ingresar Pregunta</h4>
         <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form enctype="multipart/form-data" id="task_form1" method="POST">
        <div class="modal-body">
            <span id="form_result"></span>
              @csrf
              <input type="hidden" id="coddocentemateria" name="coddocentemateria" value="">
              <div class="col-lg-12">
                <label for="pregunta">Seleccionar de Tipo de Pregunta</label>
                <select id="pregunta" name="tipo" class="form-control" onchange="cambio(this.value)">
                    <option value="UNIR">UNIR</option>
                    <option value="COMPLETAR">COMPLETAR</option>
                    <option value="SELECCION SIMPLE">SELECCION SIMPLE</option>
                    <option value="SELECCION MULTIPLE">SELECCION MULTIPLE</option>
                    <option value="VERDADERO FALSO">VERDADERO FALSO</option>
                </select>
              </div>
              <div  id='tipo_pregunta'>
              </div>
        </div>
        <div class="col-lg-12" style="padding-top: 20px"></div>
        <div class="modal-footer text-center col-lg-12" style="text-align:center;justify-content:center">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary btn-separacion" value="Guardar" id="Guardar" name="Guardar">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
