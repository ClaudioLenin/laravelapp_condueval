$(document).ready(function () {
  $('#collapsible-panels a').click(function (e) {

        $(this).parent().toggleClass('active');
        e.preventDefault();
    });
  //MOSTRAR FORMULARIO DE PREGUNTAS
  ocultar_contenido4();
  function mostrar_contenido4(){
    document.getElementById('contenido_4').style.display = 'block';
  }
  function ocultar_contenido4(){
    document.getElementById('contenido_4').style.display = 'none';
  }


  document.getElementById('load').style.display = 'none';
    //CARGAR SECCION
    cargar_seccion();
    function cargar_seccion(){

      document.getElementById('load').style.display = 'block';
        var codperiodo = $("#periodo4 option:selected").val(); //CAMBIAR EL CODIGO 44
        //var codperiodo = 44; //CAMBIAR EL CODIGO 44
        $.ajax({
            url: 'seccion',
            type: 'GET',
            data: {codperiodo},
            success: function (response) {
                let tasks = JSON.parse(response);
                let template = '<option selected="true" disabled="disabled">--Sección--</option>';
                tasks.forEach(task => {
                    template += `<option value='${task.codperiodoseccion}'>${task.nomseccion}</option>`;
                })
                $('#seccion4').html(template);
                document.getElementById('load').style.display = 'none';
            }
        });
        ocultar_contenido4();
    }
    //CARGAR PARALELO
    $('#seccion4').change(function () {
      document.getElementById('load').style.display = 'block';
        var codperiodoseccion = $("#seccion4 option:selected").val();
        $.ajax({
            url: 'paralelo',
            type: 'GET',
            data: {codperiodoseccion},
            success: function (response) {
                let tasks = JSON.parse(response);
                let template = '<option selected="true" disabled="disabled">--Paralelo--</option>';
                tasks.forEach(task => {
                    template += `<option value='${task.codperiodoseccionparalelo}'>${task.codparalelo}</option>`;
                })
                $('#paralelo4').html(template);
                document.getElementById('load').style.display = 'none';
            }
        });
        ocultar_contenido4();
    });
    //CARGAR MATERIA
    $('#paralelo4').change(function () {
      document.getElementById('load').style.display = 'block';
        var codperiodoseccionparalelo = $("#paralelo4 option:selected").val();
        $.ajax({
            url: 'materia',
            type: 'GET',
            data: {codperiodoseccionparalelo},
            success: function (response) {
                let tasks = JSON.parse(response);
                let template = '<option selected="true" disabled="disabled">--Materia--</option>';
                tasks.forEach(task => {
                    template += `<option value='${task.coddocentemateria}'>${task.nommateria}</option>`;
                })
                $('#materia4').html(template);
                document.getElementById('load').style.display = 'none';
            }
        });
        ocultar_contenido4();
    });
    $('#materia4').change(function () {
        document.getElementById('load').style.display = 'block';
        var coddocentemateria = $("#materia4 option:selected").val();
        //alert(coddocentemateria);
        $.ajax({
            url: 'evaluacion4',
            type: 'GET',
            data: {coddocentemateria},
            success: function (response) {
              console.log(response);
                let tasks = JSON.parse(response);
                let template = '<option selected="true" disabled="disabled">--EVALUACION--</option>';
                tasks.forEach(task => {
                    template += `<option value='${task.codexamen}'>${task.descripcion}</option>`;
                })
                $('#evaluacion4').html(template);
                document.getElementById('load').style.display = 'none';
            }
        });
        ocultar_contenido4();
    });
    $('#evaluacion4').change(function () {
      mostrardocente4();
      mostrarReporte4();
      mostrar_contenido4();
    });
    function mostrardocente4(){
      document.getElementById('load').style.display = 'block';
      var coddocentemateria = $("#materia4 option:selected").val();
      $.ajax({
          url: 'docente',
          type: 'GET',
          data: {coddocentemateria},
          success: function (response) {
            console.log(response);
            $('#docente4').html(response);
            document.getElementById('load').style.display = 'none';
          }
      });
    }

    //MOSTRAR REPORTES
        function mostrarReporte4() {
          document.getElementById('load').style.display = 'block';
            var codexamen = $("#evaluacion4 option:selected").val();
            $.ajax({
                url: 'reporte4',
                type: 'GET',
                data: {codexamen},
                success: function (response) {
                  $('#container4').html(response);
                  document.getElementById('load').style.display = 'none';
                }
            });

        }
});
