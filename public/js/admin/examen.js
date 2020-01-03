$(document).ready(function () {

    $('#materia').change(function () {
      var coddocentemateria = $("#materia option:selected").val();
        mostrarExamenes();
        document.getElementById("coddocentemateria").value = coddocentemateria;
        mostrarPreguntasExamen();
    });
    //MOSTRAR EXAMENES
    function mostrarExamenes() {
        let coddocentemateria = $("#materia option:selected").val();

        $.ajax({
            url: 'mostrarexamenes',
            type: 'GET',
            data: {coddocentemateria},
            success: function (response) {
                $('#examenes').empty().html(response);
                //document.getElementById('examenes').innerHTML = template;
            }
        });
    }
    //MOSTRAR PREGUNTAS
    function mostrarPreguntasExamen() {
        let coddocentemateria = $("#materia option:selected").val();

        $.ajax({
            url: 'mostrarpreguntasexamen',
            type: 'GET',
            data: {coddocentemateria},
            success: function (response) {
              let tasks = JSON.parse(response);
              let template = '';
              tasks.forEach(task => {
                  template +=
                          `<tr>
                              <td style='text-align:center'>
                                  <input class="estilo-check" type="checkbox" id="preguntas[]" name="preguntas[]" value='${task.codpregunta}'>
                              </td>
                              <td>${task.valor},00</td>
                              <td class='color-pregunta'>${task.pregunta}</td>
                              <td>${task.tipo}</td>
                          </tr>`;

              });
              $('#listado2_preguntas').empty().html(template);
            }
        });
    }

    //GUARDAR EXAMEN
    $('#examen').submit(function (e) {
        e.preventDefault();
        var datos = new FormData($('#examen')[0]);
        $.ajax({
            url: 'guardarexamen',
            type: 'POST',
            data: datos,
            contentType: false,
            processData: false,
            success: function (response) {
              console.log(response);
              mostrarExamenes();
              $('#examen').trigger('reset');
                if (response == 'KO') {
                  $('#mensaje_examen').empty().html("No se ha generado la evaluación, pulse aceptar y verifique que todos los datos ingresados sean correctos");
                  $('#confirm_examen').modal('show');
                } else {
                  $('#mensaje_examen').empty().html("Evaluación Generada correctamente, pulse aceptar");
                  $('#examen').trigger('reset');
                  mostrarExamenes();
                  $('#confirm_examen').modal('show');
                }
            }

        });

    });

    //ELIMINAR EXAMEN
    $(document).on('click', '#eliminar_examen', function () {
      let element = $(this)[0].parentElement;
      let id = $(element).attr('idp');
      $.ajax({
        method:'get',
        url:"eliminarexamen",
        data: {id:id},
        success: function (response)
        {
          mostrarExamenes();
        }

      });
    });
});
