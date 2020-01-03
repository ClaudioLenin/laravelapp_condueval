$(document).ready(function () {

  //MOSTRAR FORMULARIO DE PREGUNTAS
  ocultar_contenido1();
  function mostrar_contenido1(){
    document.getElementById('contenido_1').style.display = 'block';
  }
  function ocultar_contenido1(){
    document.getElementById('contenido_1').style.display = 'none';
  }


  document.getElementById('load').style.display = 'none';
  //CARGAR SECCION
  cargar_seccion();
  function cargar_seccion(){

    document.getElementById('load').style.display = 'block';
      var codperiodo = $("#periodo1 option:selected").val(); //CAMBIAR EL CODIGO 44
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
              $('#seccion1').html(template);
              document.getElementById('load').style.display = 'none';
          }
      });
      ocultar_contenido1();
  }
    //CARGAR PARALELO
    $('#seccion1').change(function () {
      document.getElementById('load').style.display = 'block';
        var codperiodoseccion = $("#seccion1 option:selected").val();
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
                $('#paralelo1').html(template);
                document.getElementById('load').style.display = 'none';
            }
        });
        ocultar_contenido1();
    });
    //CARGAR MATERIA
    $('#paralelo1').change(function () {
      document.getElementById('load').style.display = 'block';
        var codperiodoseccionparalelo = $("#paralelo1 option:selected").val();
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
                $('#materia1').html(template);
                document.getElementById('load').style.display = 'none';
            }
        });
        ocultar_contenido1();
    });
    $('#materia1').change(function () {
        //var coddocentemateria = $("#materia1 option:selected").val();
        //document.getElementById("coddocentemateria").value = coddocentemateria;ç
        mostrardocente();
        mostrarReporte1();
        mostrar_contenido1();
    });


    //MOSTRAR REPORTES
        function mostrarReporte1() {
          document.getElementById('load').style.display = 'block';
            var coddocentemateria = $("#materia1 option:selected").val();
            $.ajax({
                url: 'reporte1',
                type: 'GET',
                data: {coddocentemateria},
                success: function (response) {
                  $('#container1').html(response);
                  document.getElementById('load').style.display = 'none';
                }
            });

        }
        function mostrardocente(){
          document.getElementById('load').style.display = 'block';
          var coddocentemateria = $("#materia1 option:selected").val();
          $.ajax({
              url: 'docente',
              type: 'GET',
              data: {coddocentemateria},
              success: function (response) {
                console.log(response);
                $('#docente1').html(response);
                document.getElementById('load').style.display = 'none';
              }
          });
        }

});
