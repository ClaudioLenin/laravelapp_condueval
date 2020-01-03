<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_modificar_{{$examen->codexamen}}">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
         <h4 class="modal-title">Modificar Evaluacion: {{$examen->descripcion}}</h4>
         <button type="button" id="close{{$examen->codexamen}}" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form id="examen_editar{{$examen->codexamen}}" method="POST">
        @csrf
        <input type="hidden" id="codexamen{{$examen->codexamen}}" name="codexamen" value="{{$examen->codexamen}}">
        <div class="modal-body">
          <div class='col-lg-12'>
            <div class="col-lg-12 col-md-12 col-xs-12">
              <div class="col-lg-12 col-md-12 col-xs-12">
                <p>Tipo de Exámen</p>
                <input type="text" value="{{$examen->descripcion}}" class="form-control" id="nombre_examen{{$examen->codexamen}}" name="nombre_examen"  placeholder="EJ. PARCIAL, FINAL, GRADO, SUPLETORIO" required>
              </div>
              <div class="col-lg-12 col-md-12 col-xs-12">
                <p>Contraseña</p>
                <input type="password" value="{{$examen->clave}}" class="form-control" id="contrasenia{{$examen->codexamen}}" name="contrasenia" placeholder="Password" required>
              </div>
              <div class="col-lg-12 col-md-12 col-xs-12">
                <p>Fecha y Hora de Inicio</p>
                <input type="datetime-local" value="{{$examen->fechaejecucion}}" id="fechaejecucion{{$examen->codexamen}}" class="form-control" name="fechaejecucion" placeholder="08/05/2019" required>
              </div>
              <div class="col-lg-12 col-md-12 col-xs-12">
                <p>Fecha y Hora de Culminación</p>
                <input type="datetime-local" value="{{$examen->fechafin}}" id="fechafin{{$examen->codexamen}}" class="form-control" name="fechafin" placeholder="08/05/2019" required>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12" style="padding-top: 20px"></div>
        <div class="modal-footer text-center col-lg-12" style="text-align:center;justify-content:center">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary btn-separacion" value="Modificar" id="Modificar{{$examen->codexamen}}" name="Modificar">Modificar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
//MODIFICAR EXAMEN
$(document).on('click', '#Modificar{{$examen->codexamen}}', function () {
  var nombre = $("#nombre_examen{{$examen->codexamen}}").val();
  var codexamen = $("#codexamen{{$examen->codexamen}}").val();
  var contrasenia = $("#contrasenia{{$examen->codexamen}}").val();
  var fechaejecucion = $("#fechaejecucion{{$examen->codexamen}}").val();
  var fechafin = $("#fechafin{{$examen->codexamen}}").val();
  $.ajax({
    method:'GET',
    url:"modificarexamen",
    data: {codexamen,nombre,contrasenia,fechaejecucion,fechafin},
    success: function (response)
    {
      let tasks = JSON.parse(response);
      tasks.forEach(task => {
        $('#estado{{$examen->codexamen}}').empty().html(`${task.estado}`);
        $('#descripcion{{$examen->codexamen}}').empty().html(`${task.descripcion}`);
        $('#fechaejecucion_{{$examen->codexamen}}').empty().html(`${task.fechaejecucion}`);
        $('#fechafin_{{$examen->codexamen}}').empty().html(`${task.fechafin}`);
      });
      $('#modal_modificar_{{$examen->codexamen}}').modal('hide');
    }

  });
});

</script>
