$(document).ready(function () {
  document.getElementById('load').style.display = 'none';
  $(document).on('click', '#materia1', function () {
    document.getElementById('load').style.display = 'block';
    let element = $(this)[0].parentElement;
    let nommateria = $(element).attr('nom');
    let iddm = $(element).attr('iddm');
    $.ajax({
            url: 'mostrarreportes',
            type: 'GET',
            data: {iddm},
            success: function (response) {
                //console.log(response);
                let tasks = JSON.parse(response);
                let template = "";
                if(tasks == ""){
                  template = `
                                          <div class="shadow-lg p-3 mb-3 rounded alert alert-dark col-lg-12 text-center" role="alert">
                                              <b>AUN NO HAY REPORTES</b>
                                          </div>
                                      `;
                }else{
                  template = `
                                          <div class="shadow-lg p-3 mb-3 rounded alert alert-dark  col-lg-12" role="alert">
                                            <div class="col-lg-12 text-center" role="alert">
                                                <b>EVALUACIONES</b>
                                            </div>
                                          </div>
                                      `;
                  tasks.forEach(task => {
                          template += `
                                        <div class="shadow-lg p-4 mb-2  rounded  col-lg-12" role="alert" style="">
                                          <div class="col-lg-12 text-justify" role="alert">
                                              <li coddocentemateria='${task.coddocentemateria}' codexamen='${task.codexamen}'><a href="/student/reporte1?codexamen=${task.codexamen}" target="_blank" id="test1" class="seleccionar_test" data-toggle="modal">${task.descripcion}</a></li>
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
      /*
     $(document).on('click', '#test1', function () {
       let element = $(this)[0].parentElement;
       codexamen = $(element).attr('codexamen');
          alert(codexamen);
     });*/
});
