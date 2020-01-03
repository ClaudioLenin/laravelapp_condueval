$(document).ready(function () {
  $('#collapsible-panels a').click(function (e) {

        $(this).parent().toggleClass('active');
        e.preventDefault();
    });
  //MOSTRAR FORMULARIO DE PREGUNTAS
  ocultar_contenido3();
  function mostrar_contenido3(){
    document.getElementById('contenido_3').style.display = 'block';
  }
  function ocultar_contenido3(){
    document.getElementById('contenido_3').style.display = 'none';
  }


  document.getElementById('load').style.display = 'none';
    //CARGAR SECCION
    $('#periodo3').change(function () {
      document.getElementById('load').style.display = 'block';
        var codperiodo = $("#periodo3 option:selected").val();
        $.ajax({
            url: 'seccion',
            type: 'GET',
            data: {codperiodo},
            success: function (response) {
                console.log(response);
                let tasks = JSON.parse(response);
                let template = '<option selected="true" disabled="disabled">--Sección--</option>';
                tasks.forEach(task => {
                    template += `<option value='${task.codperiodoseccion}'>${task.nomseccion}</option>`;
                })
                $('#seccion3').html(template);
                document.getElementById('load').style.display = 'none';
            }
        });
        ocultar_contenido3();
    });
    //CARGAR PARALELO
    $('#seccion3').change(function () {
      document.getElementById('load').style.display = 'block';
        var codperiodoseccion = $("#seccion3 option:selected").val();
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
                $('#paralelo3').html(template);
                document.getElementById('load').style.display = 'none';
            }
        });
        ocultar_contenido3();
    });
    //CARGAR MATERIA
    $('#paralelo3').change(function () {
      document.getElementById('load').style.display = 'block';
        var codperiodoseccionparalelo = $("#paralelo3 option:selected").val();
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
                $('#materia3').html(template);
                document.getElementById('load').style.display = 'none';
            }
        });
        ocultar_contenido3();
    });
    $('#materia3').change(function () {
        //var coddocentemateria = $("#materia1 option:selected").val();
        //document.getElementById("coddocentemateria").value = coddocentemateria;ç
        mostrardocente3();
        mostrarReporte3();
        mostrar_contenido3();
    });
    function mostrardocente3(){
      document.getElementById('load').style.display = 'block';
      var coddocentemateria = $("#materia3 option:selected").val();
      $.ajax({
          url: 'docente',
          type: 'GET',
          data: {coddocentemateria},
          success: function (response) {
            console.log(response);
            $('#docente3').html(response);
            document.getElementById('load').style.display = 'none';
          }
      });
    }

    //MOSTRAR REPORTES
        function mostrarReporte3() {
          var codperiodo = $("#periodo3 option:selected").val();
          var codperiodoseccion = $("#seccion3 option:selected").val();
          var codperiodoseccionparalelo = $("#paralelo3 option:selected").val();
          var coddocentemateria = $("#materia3 option:selected").val();

          document.getElementById("codperiodo3").value = codperiodo;
          document.getElementById("codperiodoseccion3").value = codperiodoseccion;
          document.getElementById("codperiodoseccionparalelo3").value = codperiodoseccionparalelo;
          document.getElementById("coddocentemateria3").value = coddocentemateria;

          document.getElementById('load').style.display = 'block';
          $.ajax({
              url: 'reporte3',
              type: 'GET',
              data: {codperiodo,codperiodoseccion,codperiodoseccionparalelo,coddocentemateria},
              success: function (response) {
                $('#container3').html(response);
                document.getElementById('load').style.display = 'none';
              }
          });
        }
});
