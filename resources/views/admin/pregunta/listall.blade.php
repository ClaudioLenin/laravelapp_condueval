
    <table class="table">
        <thead>
            <tr>
                <th class="text-center">N.</th>
                <th class="text-center">PTS.</th>
                <th class="text-center">TIPO</th>
                <th class="text-center">PREGUNTA</th>
                <th class="text-center">RESPUESTA</th>
                <th class="text-center">OPCIONES</th>
            </tr>
        </thead>
          <tbody>
            @php
              $cont = 0;
            @endphp
            @foreach ($preguntas as $pregunta)
              @php
                $cont ++;
              @endphp
              <tr idp='{{$pregunta->codpregunta}}'>
                <td class="text-center">{{$cont}}</td>
                <td class="text-center">{{$pregunta->valor}},00</td>
                <td class="text-center"><b>{{$pregunta->tipo}}</b></td>
                <td>
                  @if($pregunta->imagen!="")
                  <div class="text-center col-sm-12"><img height="100px" width="100px" class="img-thumbnail " src="{{asset('images/resources/'.$pregunta->imagen)}}" alt="Sin recurso imagen"></div>
                  <br>
                  @endif
                  <div class="text-justify">
                    {{$pregunta->pregunta}}
                  </div>
                </td>
                <td id='{{$pregunta->codpregunta}}'>
                  @if($pregunta->tipo == "UNIR")
                    @include('admin.pregunta.unirmodal')
                  @endif
                  @if($pregunta->tipo == "COMPLETAR")
                    @include('admin.pregunta.completarmodal')
                  @endif
                  @if($pregunta->tipo == "SELECCION SIMPLE")
                    @include('admin.pregunta.ssimplemodal')
                  @endif
                  @if($pregunta->tipo == "SELECCION MULTIPLE")
                    @include('admin.pregunta.smultiplemodal')
                  @endif
                  @if($pregunta->tipo == "VERDADERO FALSO")
                    @include('admin.pregunta.vfmodal')
                  @endif
                  <div id="mostrar_respuesta{{$pregunta->codpregunta}}" class="text-justify">
                  </div>

                  <script  type="text/javascript">
                  function mostrarRespuesta(codpregunta,tipo) {
                    $.ajax({
                      type:'get',
                      url:'mostrarrespuesta',
                      data: {codpregunta},
                      success:function(response){
                        let tasks = JSON.parse(response);
                        let template = '';
                        if(tipo == 'UNIR'){
                          var preguntas = "";
                          tasks.forEach(task => {
                            if (task['correcta'] == "SI") {
                              preguntas+=`
                                <div style='padding-bottom: 5px' class='col-xs-6'>
                                    <input type='text' name='${task.codlista}' value='${task.enunciado}' placeholder='Pregunta' class='form-control name_list' required/>
                                </div>
                                <div  style='padding-bottom: 5px;' class='col-xs-6'>
                                    <input type='text' name='${task.codrespuesta}' value='${task.respuesta}' placeholder='Respuesta' class='form-control name_list' required/>
                                </div>
                              `;
                              template +=`<div class='col-lg-5'>${task.enunciado}</div>
                                          <div class='col-lg-1'>&harr;</div>
                                          <div class='col-lg-5'>${task.respuesta}</div>
                                          <div class='col-lg-12'></div>`;
                            }
                          });
                          document.getElementById("preguntas"+codpregunta).innerHTML = preguntas;
                        }else if(tipo=='COMPLETAR'){
                          template = '<b>RESPUESTA CORRECTA:</b>';
                          let cadena='';
                          tasks.forEach(task => {
                            if (task['tipo'] == "TEXTO"){
                              cadena+=`<div class='col-lg-4 col-md-6 col-xs-12'>
                                <input type="text" name='${task.codparte}' value='${task.cadena}' placeholder="Cadena de Texto" class="form-control name_list" required/>
                              </div>`;
                              template +=` ${task.cadena}`;
                            }
                            else{
                              cadena+=`<div class='col-lg-4 col-md-6 col-xs-12'>
                                <input type="text" name='${task.codparte}' value='${task.cadena}' placeholder="Completar" class="form-control name_list" style="background-color:#ffe0b2;" required/>
                              </div>`;
                              template +=` <b><u>${task.cadena}</u></b>`;
                            }
                          });
                          document.getElementById("segmentos"+codpregunta).innerHTML = cadena;
                        }else if(tipo == "VERDADERO FALSO"){
                          tasks.forEach(task => {
                            template +=` <b>RESPUESTA CORRECTA:</b> ${task.respuesta}<br>`;
                            if(task['respuesta']=='verdadero')
                              document.getElementById("verdadero"+codpregunta).checked = true;
                            else
                              document.getElementById("falso"+codpregunta).checked = true;
                          });
                        }else if(tipo == "SELECCION SIMPLE"){//RESPUESTA SELECCION SIMPLE
                          let correcta = "";
                          let otras = "";
                          tasks.forEach(task => {
                            if (task['correcta'] == "SI"){
                                correcta += `<tr class="col-xs-12"><div class='col-xs-3'>Respuesta Correcta: </div><div class='col-xs-9'><input input class="col-xs-12" value="${task.respuesta}" type='text' name='${task.codrespuesta}'  placeholder='Respuesta Correcta' class='form-control name_list' required></div></tr>`;
                                template +=`<b>RESPUESTA CORRECTA:</b> ${task.respuesta}<br>`;
                            }
                            else{
                                otras += `<tr class="col-xs-12"><div class='col-xs-3'>Otra Opción: </div><div class='col-xs-9'><input class="col-xs-12" value="${task.respuesta}" type="text" name="${task.codrespuesta}" placeholder="Otra Opción" class="form-control name_list" required/></div></tr>`;
                                template +=`<b>OTRA OPCION:</b> ${task.respuesta}<br>`;
                            }
                          });
                          document.getElementById("correcta"+codpregunta).innerHTML = correcta;
                          document.getElementById("otras"+codpregunta).innerHTML = otras;
                        }else if(tipo == "SELECCION MULTIPLE"){
                          let correctas = "";
                          let incorrectas = "";
                          tasks.forEach(task => {
                            if (task['correcta'] == "SI"){
                                correctas += `<tr class="col-xs-12"><div class='col-xs-3'>Respuesta Correcta: </div><div class='col-xs-9'><input input class="col-xs-12" value="${task.respuesta}" type='text' name='${task.codrespuesta}'  placeholder='Respuesta Correcta' class='form-control name_list' required></div></tr>`;
                                template +=`<b>RESPUESTA CORRECTA:</b> ${task.respuesta}<br>`;
                            }
                            else{
                                incorrectas += `<tr class="col-xs-12"><div class='col-xs-3'>Otra Opción: </div><div class='col-xs-9'><input class="col-xs-12" value="${task.respuesta}" type="text" name="${task.codrespuesta}" placeholder="Otra Opción" class="form-control name_list" required/></div></tr>`;
                                template +=`<b>OTRA OPCION:</b> ${task.respuesta}<br>`;
                            }
                          });
                          document.getElementById("correctas"+codpregunta).innerHTML = correctas;
                          document.getElementById("incorrectas"+codpregunta).innerHTML = incorrectas;
                        }else {
                          tasks.forEach(task => {
                            if (task['correcta'] == "SI")
                              template +=`<b>RESPUESTA CORRECTA:</b> ${task.respuesta}<br>`;
                            else
                              template +=`<b>OTRA OPCION:</b> ${task.respuesta}<br>`;
                          });
                        }
                        $('#mostrar_respuesta'+codpregunta).empty().html(template);
                        //document.getElementById("mostrar_respuesta"+codpregunta).innerHTML = template;
                      }
                    });
                  }
                  mostrarRespuesta({{$pregunta->codpregunta}},"{{$pregunta->tipo}}");


                  //MODIFICAR PREGUNTA
                  $('#task-edit-{{$pregunta->codpregunta}}').submit(function (e) {
                      document.getElementById('load').style.display = 'block';
                      var datos = new FormData($('#task-edit-{{$pregunta->codpregunta}}')[0]);
                      $.ajax({
                          url: 'modificarpregunta',
                          type: 'POST',
                          data: datos,
                          contentType: false,
                          processData: false,
                          success: function (response) {
                              console.log(response);
                              var close = document.getElementById("close"+{{$pregunta->codpregunta}});
                              close.click();
                              listPreguntas();
                          }

                      });
                      e.preventDefault();
                  });
                  function listPreguntas(){
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



                  </script>
                </td>
                <td class="text-center" idp='{{$pregunta->codpregunta}}'>
                  <a data-target="#modal_modificar_{{$pregunta->codpregunta}}" data-toggle="modal"><button class="btn btn-info" id="abrir_modal_editar">Editar</button></a>
						      <a data-target="#modal_eliminar_{{$pregunta->codpregunta}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                </td>
              </tr>
              @include('admin.pregunta.modal')
            @endforeach
          </tbody>
    </table>
  <div class="text-center">
{!!$preguntas->links()!!}
  </div>
