$(document).ready(function () {
  $('#collapsible-panels a').click(function (e) {

        $(this).parent().toggleClass('active');
        e.preventDefault();
    });
  //MOSTRAR FORMULARIO DE PREGUNTAS
  ocultar_contenido2();
  function mostrar_contenido2(){
    document.getElementById('contenido_2').style.display = 'block';
  }
  function ocultar_contenido2(){
    document.getElementById('contenido_2').style.display = 'none';
  }


  document.getElementById('load').style.display = 'none';
    //CARGAR SECCION
    cargar_seccion();
    function cargar_seccion(){

      document.getElementById('load').style.display = 'block';
        var codperiodo = $("#periodo2 option:selected").val(); //CAMBIAR EL CODIGO 44
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
                $('#seccion2').html(template);
                document.getElementById('load').style.display = 'none';
            }
        });
        ocultar_contenido2();
    }
    //CARGAR PARALELO
    $('#seccion2').change(function () {
      document.getElementById('load').style.display = 'block';
        var codperiodoseccion = $("#seccion2 option:selected").val();
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
                $('#paralelo2').html(template);
                document.getElementById('load').style.display = 'none';
            }
        });
        ocultar_contenido2();
    });
    //CARGAR MATERIA
    $('#paralelo2').change(function () {
      mostrarReporte2();
      mostrar_contenido2();
    });

    //MOSTRAR REPORTES
        function mostrarReporte2() {
          var codperiodo = $("#periodo2 option:selected").val();
          var codperiodoseccion = $("#seccion2 option:selected").val();
          var codperiodoseccionparalelo = $("#paralelo2 option:selected").val();
          document.getElementById("codperiodo").value = codperiodo;
          document.getElementById("codperiodoseccion").value = codperiodoseccion;
          document.getElementById("codperiodoseccionparalelo").value = codperiodoseccionparalelo;

          document.getElementById('load').style.display = 'block';
          $.ajax({
              url: 'reporte2',
              type: 'GET',
              data: {codperiodo,codperiodoseccion,codperiodoseccionparalelo},
              success: function (response) {
                $('#container2').html(response);
                document.getElementById('load').style.display = 'none';
              }
          });
        }
});
