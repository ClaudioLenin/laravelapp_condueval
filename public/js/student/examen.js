$(document).ready(function () {
  document.getElementById('load').style.display = 'none';
  $(document).on('click', '#materia', function () {
    document.getElementById('load').style.display = 'block';
    let element = $(this)[0].parentElement;
    let nommateria = $(element).attr('nom');
    let iddm = $(element).attr('iddm');
    $.ajax({
            url: 'mostrarevaluaciones',
            type: 'GET',
            data: {iddm},
            success: function (response) {
                //console.log(response);
                let tasks = JSON.parse(response);
                let template = "";
                if(tasks == ""){
                  template = `
                                          <div class="shadow-lg p-3 mb-3 rounded alert alert-dark col-lg-12 text-center" role="alert">
                                              <b>AUN NO HAY VALUACIONES</b>
                                          </div>
                                      `;
                }else{
                  template = `
                                          <div class="shadow-lg p-3 mb-3 rounded alert alert-dark  col-lg-12" role="alert">
                                            <div class="col-lg-6 text-center" role="alert">
                                                <b>DESCRIPCIÓN</b>
                                            </div>
                                            <div class="col-lg-6 text-center" >
                                                <b>DISPONIBILIDAD</b>
                                            </div>
                                          </div>
                                      `;
                  tasks.forEach(task => {
                          template += `
                                        <div class="shadow-lg p-3 mb-2 bg-white rounded  col-lg-12" role="alert">
                                          <div class="col-lg-6 text-justify" role="alert">
                                              <li coddocentemateria='${task.coddocentemateria}' codexamen='${task.codexamen}'><a href="#" id="test" class="seleccionar_test" data-toggle="modal">${task.descripcion}</a></li>
                                          </div>
                                          <div class="col-lg-3 text-center">
                                              <b>Desde:</b>&nbsp;&nbsp;${task.fechaejecucion}
                                          </div>
                                          <div class="col-lg-3 text-center">
                                              <b>Hasta: </b>${task.fechafin}
                                          </div>
                                        </div>
                                      `;
                  })
                }
                $('#examenes').html(template);
                $('#identificador-asignatura').html(nommateria);
                //alert(response);
                document.getElementById('load').style.display = 'none';
            }
        });
   });
      let codexamen = 0;
     $(document).on('click', '#test', function () {
       let element = $(this)[0].parentElement;
       codexamen = $(element).attr('codexamen');
       document.getElementById("codexamen").value = codexamen;
       $.ajax({
               url: 'comprobarexamen',
               type: 'GET',
               data: {codexamen},
               success: function (response) {
                 console.log(response);
                   if(response != "null"){
                     $('#exampleModalCenter').modal('hide');
                     $('#exampleModalCenter2').modal('show');
                   }else{
                     $('#exampleModalCenter').modal('show');
                     $('#exampleModalCenter2').modal('hide');
                   }
               }
           });
     });


     $('#contrasenia_evaluacion').submit(function (e) {
         var datos = new FormData($('#contrasenia_evaluacion')[0]);
         $.ajax({
             url: 'verificarcontrasenia',
             type: 'POST',
             data: datos,
             contentType: false,
             processData: false,
             success: function (response) {
               if(response == "null"){
                 $('#confirmacion_contrasenia').html("Contraseña Incorrecta");
                 $('#contrasenia_evaluacion').trigger('reset');
               }else if(response == 'ko'){
                 $('#confirmacion_contrasenia').html("Esta evaluación aun no esta habilitado");
                 $('#contrasenia_evaluacion').trigger('reset');
               }else {
                 $('#confirmacion_contrasenia').html("");
                 $('#contrasenia_evaluacion').trigger('reset');
                 var cerrar = document.getElementById("cerrar");
                 cerrar.click();
                 location.replace("traerexamen?codexamen="+codexamen);
                 //myWindow.opener.document.write("<p>This is the source window!</p>");
               }
             }
         });
         e.preventDefault();
     });
});
