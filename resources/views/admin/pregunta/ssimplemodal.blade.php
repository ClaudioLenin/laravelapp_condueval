<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_modificar_{{$pregunta->codpregunta}}">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
         <h4 class="modal-title">Modificar Pregunta de Selección Simple</h4>
         <button type="button" id="close{{$pregunta->codpregunta}}"  class="close" data-dismiss="modal">&times;</button>
      </div>
      <form enctype="multipart/form-data" id="task-edit-{{$pregunta->codpregunta}}" method="POST">
        @csrf
        <input type="hidden" name="tipo" value="{{$pregunta->tipo}}">
        <input type="hidden" name="codpregunta" value="{{$pregunta->codpregunta}}">
        <div class="modal-body">
          <div class='col-lg-12 zigzag' id='tipo_pregunta'>
              <label for='pregunta'>Ingrese Pregunta</label>
              <textarea class='form-control' id='pregunta' rows='4' style='resize: none' name='pregunta' required>{{$pregunta->pregunta}}</textarea><br/><br/>
              <div class='table-responsive'>
                  <label for='correcta'>Ingrese Opciones</label>
                  <table id='tabla_dinamica' class='col-lg-12'>
                      <div class='col-xs-12' id="correcta{{$pregunta->codpregunta}}">
                      </div>
                      <div class='col-xs-12' id="otras{{$pregunta->codpregunta}}">
                      </div>
                  </table>
              </div>
              <div class='col-lg-12'>
                  <div class='col-lg-6'>
                      <div class='col-xs-12' style='text-align:center;justify-content:center;'>
                          <div class='col-xs-12'>
                            <label for='valor'>Calificación</label><br/>
                          </div>
                          <div class='col-xs-12' >
                            <select size='3' class='custom-select' name='valor'>
                              @for($i=1;$i<=20;$i++)
                                @if($pregunta->valor == $i)
                                  <option selected>{{$i}}</option>
                                @else
                                  <option>{{$i}}</option>
                                @endif
                              @endfor
                            </select>
                          </div>
                      </div>
                  </div>
                  <div class='col-lg-6'>
                      <div class='col-xs-12' style='text-align:center;justify-content:center;'>
                          <div class='col-xs-12'>
                              <label for='imagen'>(Opcional) Imagen</label><br/>
                          </div>
                          <div class='col-xs-12' >
                               <input type='file' class='btn btn btn-warning' name='imagen'>
                          </div>
                      </div>
                  </div>
              </div><br/><br/>
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
