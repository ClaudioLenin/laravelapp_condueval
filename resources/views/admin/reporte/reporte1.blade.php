@extends ('layouts.plantilla')
@section ('content_2')
<div class="row">
  <div class="col-md-12">
    <div class="box">
        <div class="box-header with-border">
        <div class="box-body">
          <div class="text-center col-lg-12">
            <span class="logo-mini"><img src="{{asset('img/conduespoch_sinletras.png')}}" width="40" height="40"></span>
          </div>
          <div class="text-center col-lg-12">
            <h3>ESCUELA DE CONDUCCION PROFESIONAL CONDUESPOCH E.P.</h3>
            <h4>PREGUNTAS DE EVALUACIÓN</h4>
          </div>
          <div class="table-responsive col-lg-12 col-sm-12 col-md-12 col-xs-12 rounded-lg p-5" style="margin-bottom:20px">
            <table class="table">
              <tbody>
                @foreach ($examen as $exam)
                  <tr>
                    <td><b>Materia: </b>{{$exam->nommateria}}</td>
                  </tr>
                  <tr>
                    <td><b>Evaluación: </b>{{$exam->descripcion}}</td>
                  </tr>
                  <tr>
                    <td><b>Fecha y hora de inicio evaluación: </b>{{$exam->fechaejecucion}}</td>
                  </tr>
                  <tr>
                    <td><b>Fecha y hora de fin evaluación: </b>{{$exam->fechafin}}</td>
                  </tr>

                @endforeach
              </tbody>
            </table>
          </div>
            <div class="box-body">
              @php
                $i = 0;
              @endphp
              @foreach ($todas as $todo)
                @php
                  $i ++;
                  $nota = 0;
                @endphp

                <div class="col-lg-12" style="padding-bottom:15px">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div class="col-lg-12" style="padding: 10px 10px 15px 10px">
                          <b>{{$i}}.- </b> {{$todo->pregunta}} <p class="text-right" style="font-size: 12px"><em>(Pregunta de: {{$todo->tipo}} equivalente a {{$todo->valor}},00 pts.)</em></p>
                          @if($todo->imagen!="")
                            <div class="text-center col-sm-12"><img height="400px" width="400px" class="img-thumbnail " src="{{asset('images/resources/'.$todo->imagen)}}" alt="Sin recurso imagen"></div>
                            <br>
                          @endif
                        </div>
                        @switch($todo->tipo)
                          @case('UNIR')
                                      <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 text-justify">
                                        @foreach ($p_unir1 as $unir1)
                                          @if($todo->codpregunta == $unir1->codpregunta)
                                          <div class="col-lg-12" style="padding-bottom: 20px">- {{$unir1->enunciado}}</div>
                                          @endif
                                        @endforeach
                                      </div>
                                      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 text-justify" >

                                      </div>
                                      <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 text-justify">
                                        @foreach ($p_unir2 as $unir2)
                                          @if($todo->codpregunta == $unir2->codpregunta)
                                          <div class="col-lg-12" style="padding-bottom: 20px">- {{$unir2->respuesta}}</div>
                                          @endif
                                        @endforeach
                                      </div>
                                      @break
                           @case('COMPLETAR')
                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify" style="padding-bottom: 20px">
                                        @foreach ($p_completar as $completar)
                                          @if($todo->codpregunta == $completar->codpregunta)
                                            @if($completar->tipo == 'TEXTO')
                                              {{$completar->cadena}}
                                            @elseif($completar->tipo == 'COMPLETAR')
                                            ____________________________,
                                            @endif
                                          @endif
                                        @endforeach
                                      </div>
                                      @break
                            @case('SELECCION MULTIPLE')
                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify">
                                        @foreach ($p_multiple as $multiple)
                                          @if($todo->codpregunta == $multiple->codpregunta)
                                            <div class="col-lg-12" style="padding-bottom: 20px"><input type="checkbox" disabled> {{$multiple->respuesta}}</div>
                                          @endif
                                        @endforeach
                                      </div>
                                      @break
                            @case('SELECCION SIMPLE')
                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify">
                                        @foreach ($p_simple as $simple)
                                          @if($todo->codpregunta == $simple->codpregunta)
                                            <div class="col-lg-12" style="padding-bottom: 20px"><input type="radio" disabled> {{$simple->respuesta}}</div>
                                          @endif
                                        @endforeach
                                      </div>
                                      @break
                             @case('VERDADERO FALSO')
                                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify">
                                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify" style="padding-bottom: 20px">
                                         <input type="radio" name="" value="" disabled> Verdadero
                                       </div>
                                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify" style="padding-bottom: 20px">
                                         <input type="radio" name="" value="" disabled> Falso
                                       </div>
                                     </div>
                                     @break
                        @endswitch

                  </div>
                </div>
              @endforeach
          </div>
          </div>
        </div><!-- /.row -->
      </div>

            </div>
          </div><!-- /.row -->
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div><!-- /.col -->
</div><!-- /.row -->
@endsection
