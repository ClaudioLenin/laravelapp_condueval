$(document).ready(function () {
  document.getElementById('load').style.display = 'none';
    //CARGAR SECCION
    cargar_seccion();
    function cargar_seccion(){
      document.getElementById('load').style.display = 'block';
        var codperiodo = $("#periodo option:selected").val(); //CAMBIAR EL CODIGO 44
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
                $('#seccion').html(template);
                document.getElementById('load').style.display = 'none';
            }
        });
        //ocultar_preguntas();
    }
    //CARGAR PARALELO
    $('#seccion').change(function () {
      document.getElementById('load').style.display = 'block';
        var codperiodoseccion = $("#seccion option:selected").val();
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
                $('#paralelo').html(template);
                document.getElementById('load').style.display = 'none';
            }
        });
        //ocultar_preguntas();
    });
    //CARGAR MATERIA
    $('#paralelo').change(function () {
      document.getElementById('load').style.display = 'block';
        var codperiodoseccionparalelo = $("#paralelo option:selected").val();
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
                $('#materia').html(template);
                document.getElementById('load').style.display = 'none';
            }
        });
        //ocultar_preguntas();
    });
    $('#materia').change(function () {
        document.getElementById('load').style.display = 'block';
        var coddocentemateria = $("#materia option:selected").val();
        document.getElementById("coddocentemateria").value = coddocentemateria;
        mostrar_preguntas();
        listaPreguntas();
        document.getElementById('load').style.display = 'none';
    });

    //MOSTRAR FORMULARIO DE PREGUNTAS

    function mostrar_preguntas(){
      document.getElementById('ocultar_tabla_preguntas').style.display = 'block';
    }/*
    function ocultar_preguntas(){
    //  document.getElementById('ocultar_tabla_preguntas').style.display = 'none';
  }*/

    //BUSCAR PREGUNTA
    //$('#task-result').hide();
    $('#search').keyup(function (e) {
      if ($('#search').val()) {
          let search = $('#search').val();
          let coddocentemateria = $("#materia option:selected").val();
          $.ajax({
              url: 'buscarpregunta',
              type: 'GET',
              data: {search, coddocentemateria},
              success: function (response) {
                $('#listado_preguntas').empty().html(response);
                document.getElementById('load').style.display = 'none';
              }
          });
      } else {
          listaPreguntas();
      }
    })
    //GUARDAR PREGUNTA
    $('#task_form1').submit(function (e) {
      document.getElementById('load').style.display = 'block';
        var datos = new FormData($('#task_form1')[0]);
        $.ajax({
            url: 'guardarpregunta2',
            type: 'POST',
            data: datos,
            contentType: false,
            processData: false,
            success: function (response) {
              if(response == "ko"){
                alert("Algo ha salido mal, revisar pregunta");
              }
                $('#task_form1').trigger('reset');
                listaPreguntas();
                cambio("UNIR");
                document.getElementById('load').style.display = 'none';
            }

        });
        e.preventDefault();
    });

    //MOSTRAR PREGUNTAS
    function listaPreguntas(){
      let coddocentemateria = $("#materia option:selected").val();
      document.getElementById('load').style.display = 'block';
      $.ajax({
          url: 'listall',
          type: 'GET',
          data: {coddocentemateria},
          success: function (data) {
            $('#listado_preguntas').empty().html(data);
            document.getElementById('load').style.display = 'none';
          }
      });
    }
    $(document).on("click",".pagination li a",function(e){
      e.preventDefault();
      var url = $(this).attr("href");
      let coddocentemateria = $("#materia option:selected").val();
      $.ajax({
        type:'get',
        url:url,
        data: {coddocentemateria},
        success:function(data){
          $('#listado_preguntas').empty().html(data);

        }
      });
    });

//PAGINACION DE EXAMENES PARA EL ADMINISTRADOR
    $(document).on("click","#paginate_exam .pagination li a",function(e){
      e.preventDefault();
      var url = $(this).attr("href");
      let coddocentemateria = $("#materia option:selected").val();
      $.ajax({
        type:'get',
        url:url,
        data: {coddocentemateria},
        success:function(data){
          $('#listado_examens').empty().html(data);

        }
      });
    });



    //MOSTRAR RESPUESTAS
    function mostrarRespuestas(codpregunta) {
      $.ajax({
        type:'get',
        url:'mostrarrespuesta',
        data: {codpregunta},
        success:function(data){
          $('#mostrar_respuesta'+codpregunta).empty().html(data);
        }
      });
    }

    //ELIMINAR PREGUNTA
    $(document).on('click', '#eliminar_pregunta', function () {
      let element = $(this)[0].parentElement;
      let id = $(element).attr('idp');
      $.ajax({
        method:'get',
        url:"eliminarpregunta",
        data: {id:id},
        success: function (response)
        {
            listaPreguntas();
        }

      });
    });
});
