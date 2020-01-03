<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Evaluaciones Digitales</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
    <link rel="stylesheet" href="{{asset('css/estilos.css')}}">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">

    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="icon" href="http://conduespoch.com/sites/default/files/cLogoMini.png" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />

  </head>
  <body class="hold-transition skin-green sidebar-mini" style="font-size: 16px;background-color:#eceff1">
    <section class="content" style="padding: 10px 10px 10px 10px">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
            <div class="box-body">
              <div class="table-responsive col-lg-12 col-sm-12 col-md-12 col-xs-12 border rounded-lg p-5" style="margin-bottom:20px">
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
                      <tr>
                        <td><b>Nombre y apellido del Estudiante: </b>{{session('nompersona')}} {{session('apepersona')}}</td>
                      </tr>
                      <tr>
                        <td><b>Calificación final de evaluación: </b>{{$nota->nota}}/20</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

                <div class="col-lg-12">
                  @php
                    $i = 0;
                  @endphp
                  @foreach ($todas as $todo)
                    @php
                      $i ++;
                      $nota = 0;
                    @endphp
                    @foreach ($r_estudiante as $calificaciones)
                      @if($todo->codpregunta == $calificaciones->codpregunta)
                        @php
                          $nota = $calificaciones->valor;
                        @endphp
                      @endif
                    @endforeach
                    <div class="col-lg-12" style="padding-bottom:15px">
                      <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12" >
                        <div class="card" style="width: 100%;">
                          <div class="card-body" style="padding-top: 3px;padding-bottom: 3px;padding-left: 15px;margin-top: 20px">
                              <h5 style="font-size: 12px">Pregunta <b style="font-size: 15px">{{$i}}</b></h5>
                              <h5 style="font-size: 12px">{{$todo->tipo}}</h5>
                              <h5 style="font-size: 12px">Puntúa como {{$todo->valor}},00 pts.</h5>
                              @if($nota == 0)
                                <span class="badge" style="background-color:#ef5350">Calificación: {{$nota}} pts.</span>
                              @else
                                <span class="badge" style="background-color:#8bc34a">Calificación: {{$nota}} pts.</span>
                              @endif
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                          <div class="card-body" style="background-color:#e1f5fe;min-height: 300px">
                            <nav class="drawer-main">
                              <ul class="nav nav-drawer">
                                <div class="col-lg-12" style="padding: 10px 10px 15px 10px">
                                  {{$todo->pregunta}}
                                  @if($todo->imagen!="")
                                    <div class="text-center col-sm-12"><img height="400px" width="400px" class="img-thumbnail " src="{{asset('images/resources/'.$todo->imagen)}}" alt="Sin recurso imagen"></div>
                                    <br>
                                  @endif
                                </div>
                                @switch($todo->tipo)
                                  @case('UNIR')
                                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                                                  @foreach ($r_estudiante as $respuestas)
                                                    @if($todo->codpregunta == $respuestas->codpregunta)
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                      {{$respuestas->pregunta}}
                                                    </div>
                                                      @foreach ($p_unir as $unir_r)
                                                        @if($todo->codpregunta == $unir_r->codpregunta)
                                                          @if($unir_r->respuesta == $respuestas->respuesta && $unir_r->enunciado == $respuestas->pregunta)
                                                          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding-bottom: 20px;">
                                                            <div class="col-lg-11 col-md-10 col-sm-11 col-xs-10" style="padding-bottom: 20px;">
                                                              <select class="form-control" disabled>
                                                                  <option selected>{{$respuestas->respuesta}}</option>
                                                              </select>
                                                            </div>
                                                            <div class="col-lg-1 col-md-2 col-sm-1 col-xs-2 py-4" style="padding-bottom: 20px;">
                                                              <i class="fa fa-check" aria-hidden="true" style="color:green"></i>
                                                            </div>
                                                          </div>
                                                          @elseif($unir_r->enunciado == $respuestas->pregunta)
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding-bottom: 20px;">
                                                              <div class="col-lg-11 col-md-10 col-sm-11 col-xs-10" style="padding-bottom: 20px;" >
                                                                <select class="form-control" disabled>
                                                                    <option style="background-color:yellow;" selected>{{$respuestas->respuesta}}</option>
                                                                </select>
                                                              </div>
                                                              <div class="col-lg-1 col-md-2 col-sm-1 col-xs-2 py-4" style="padding-bottom: 20px;">
                                                                <i class="fa fa-times" aria-hidden="true" style="color:red"></i>
                                                              </div>
                                                            </div>
                                                          @endif
                                                        @endif
                                                      @endforeach
                                                    @break
                                                    @endif
                                                  @endforeach
                                                </div>
                                              </div>
                                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert" role="alert" style="background-color:#fff59d;margin-top:20px;color:#757575;font-size:13px">
                                                <b>Respuesta Correcta: </b><em>
                                                @foreach ($p_unir as $unir_r)
                                                  @if($todo->codpregunta == $unir_r->codpregunta)
                                                    {{$unir_r->enunciado}} &#8660; {{$unir_r->respuesta}};
                                                  @endif
                                                @endforeach
                                                </em>
                                              </div>
                                              @break
                                   @case('COMPLETAR')
                                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify" style="padding-bottom: 20px">
                                                @foreach ($p_completar as $completar)
                                                  @if($todo->codpregunta == $completar->codpregunta)
                                                    @if($completar->tipo == 'TEXTO')
                                                      {{$completar->cadena}}
                                                    @elseif($completar->tipo == 'COMPLETAR')
                                                      @foreach ($r_estudiante as $respuestas)
                                                        @if(($completar->numero == $respuestas->numero) && ($todo->codpregunta == $respuestas->codpregunta))
                                                          @if(trim(strtolower($completar->cadena)) == trim(strtolower($respuestas->respuesta)))
                                                            <input type='text' value="{{$respuestas->respuesta}}" disabled style="background-color: #aed581">&nbsp;<i class="fa fa-check" aria-hidden="true" style="color:green"></i>
                                                          @else
                                                            <input type='text' value="{{$respuestas->respuesta}}" disabled style="background-color: #e57373">&nbsp;<i class="fa fa-times" aria-hidden="true" style="color:red"></i>
                                                          @endif

                                                        @endif
                                                      @endforeach
                                                    @endif
                                                  @endif
                                                @endforeach
                                              </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert" role="alert" style="background-color:#fff59d;margin-top:20px;color:#757575;font-size:13px">
                                                  <b>Respuesta Correcta: </b><em>
                                                  @foreach ($p_completar as $completar)
                                                    @if($todo->codpregunta == $completar->codpregunta)
                                                      @if($completar->tipo == 'TEXTO')
                                                        {{$completar->cadena}},
                                                      @elseif($completar->tipo == 'COMPLETAR')
                                                         <u>{{$completar->cadena}}</u>
                                                      @endif
                                                    @endif
                                                  @endforeach
                                                  </em>
                                                </div>
                                              @break
                                    @case('SELECCION MULTIPLE')
                                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify">
                                                @foreach ($p_multiple as $multiple)
                                                  @php
                                                    $band = 0;
                                                  @endphp
                                                  @if($todo->codpregunta == $multiple->codpregunta)
                                                    @foreach ($r_estudiante as $respuestas)
                                                      @if((trim($respuestas->respuesta) == trim($multiple->respuesta)) && ($todo->codpregunta == $respuestas->codpregunta))
                                                        @php
                                                          $band = 1;
                                                        @endphp
                                                        @if($multiple->correcta == 'SI')
                                                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify" style="padding-bottom: 20px">
                                                            <input type="checkbox" name="smultiple{{$multiple->codrespuesta}}" checked disabled> {{$multiple->respuesta}}&nbsp;<i class="fa fa-check" aria-hidden="true" style="color:green"></i>
                                                          </div>
                                                        @else
                                                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify" style="padding-bottom: 20px">
                                                            <input type="checkbox" name="smultiple{{$multiple->codrespuesta}}" checked disabled> {{$multiple->respuesta}}&nbsp;<i class="fa fa-times" aria-hidden="true" style="color:red"></i>
                                                          </div>
                                                        @endif
                                                      @endif
                                                    @endforeach
                                                    @if($band == 0)
                                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify" style="padding-bottom: 20px">
                                                        <input type="checkbox" name="smultiple{{$multiple->codrespuesta}}" disabled> {{$multiple->respuesta}}
                                                      </div>
                                                    @endif
                                                  @endif
                                                @endforeach
                                              </div>
                                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert" role="alert" style="background-color:#fff59d;margin-top:20px;color:#757575;font-size:13px">
                                                <b>Respuesta Correcta: </b><em>
                                                  @foreach ($p_multiple as $multiple)
                                                    @if($todo->codpregunta == $multiple->codpregunta)
                                                      @if($multiple->correcta == "SI")
                                                        - {{$multiple->respuesta}}
                                                      @endif
                                                    @endif
                                                  @endforeach
                                                </em>
                                              </div>
                                              @break
                                    @case('SELECCION SIMPLE')
                                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify">

                                                @foreach ($p_simple as $simple)
                                                  @php
                                                    $band = 0;
                                                  @endphp
                                                  @if($todo->codpregunta == $simple->codpregunta)
                                                    @foreach ($r_estudiante as $respuestas)
                                                      @if((trim($respuestas->respuesta) == trim($simple->respuesta)) && ($todo->codpregunta == $respuestas->codpregunta))
                                                        @php
                                                          $band = 1;
                                                        @endphp
                                                        @if($respuestas->valor != 0)
                                                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify" style="padding-bottom: 20px">
                                                            <input type='radio' name="ssimple{{$todo->codpregunta}}" disabled checked> {{$simple->respuesta}}&nbsp;<i class="fa fa-check" aria-hidden="true" style="color:green"></i>
                                                          </div>
                                                        @else
                                                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify" style="padding-bottom: 20px">
                                                            <input type='radio' name="ssimple{{$todo->codpregunta}}" disabled checked> {{$simple->respuesta}}&nbsp;<i class="fa fa-times" aria-hidden="true" style="color:red"></i>
                                                          </div>
                                                        @endif
                                                      @endif
                                                    @endforeach
                                                    @if($band == 0)
                                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify" style="padding-bottom: 20px">
                                                        <input type='radio' name="ssimple{{$todo->codpregunta}}" disabled> {{$simple->respuesta}}
                                                      </div>
                                                    @endif
                                                  @endif
                                                @endforeach
                                              </div>
                                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert" role="alert" style="background-color:#fff59d;margin-top:20px;color:#757575;font-size:13px">
                                                <b>Respuesta Correcta: </b><em>
                                                  @foreach ($p_simple as $simple)
                                                    @if($todo->codpregunta == $simple->codpregunta)
                                                      @if($simple->correcta == "SI")
                                                        {{$simple->respuesta}}
                                                      @endif
                                                    @endif
                                                  @endforeach
                                                </em>
                                              </div>
                                              @break
                                     @case('VERDADERO FALSO')
                                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify">
                                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify" style="padding-bottom: 20px">
                                                 @php
                                                   $r = "";
                                                   $m = "";
                                                 @endphp
                                                 @foreach ($r_estudiante  as $respuestas)
                                                   @if($todo->codpregunta == $respuestas->codpregunta)
                                                     @if($respuestas->valor != 0)
                                                       @php
                                                         $r = $respuestas->respuesta;
                                                       @endphp
                                                     @else
                                                       @php
                                                         $m = $respuestas->respuesta;
                                                       @endphp
                                                     @endif
                                                   @endif
                                                 @endforeach
                                                 @if($r == 'verdadero')
                                                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify" style="padding-bottom: 20px">
                                                     <input type='radio' value='verdadero' disabled checked> Verdadero&nbsp;<i class="fa fa-check" aria-hidden="true" style="color:green"></i>
                                                   </div>
                                                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify" style="padding-bottom: 20px">
                                                     <input type='radio' value='falso' disabled> Falso
                                                   </div>
                                                 @elseif($r == 'falso')
                                                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify" style="padding-bottom: 20px">
                                                     <input type='radio' value='verdadero' disabled> Verdadero
                                                   </div>
                                                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify" style="padding-bottom: 20px">
                                                     <input type='radio' value='falso' disabled checked> Falso&nbsp;<i class="fa fa-check" aria-hidden="true" style="color:green"></i>
                                                   </div>
                                                 @elseif($m == 'verdadero')
                                                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify" style="padding-bottom: 20px">
                                                     <input type='radio' value='verdadero' disabled checked> Verdadero&nbsp;<i class="fa fa-times" aria-hidden="true" style="color:red"></i>
                                                   </div>
                                                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify" style="padding-bottom: 20px">
                                                     <input type='radio' value='falso' disabled> Falso
                                                   </div>
                                                 @elseif($m == 'falso')
                                                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify" style="padding-bottom: 20px">
                                                     <input type='radio' value='verdadero' disabled> Verdadero
                                                   </div>
                                                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify" style="padding-bottom: 20px">
                                                     <input type='radio' value='falso' disabled checked> Falso&nbsp;<i class="fa fa-times" aria-hidden="true" style="color:red"></i>
                                                   </div>
                                                 @endif
                                               </div>
                                             </div>
                                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert" role="alert" style="background-color:#fff59d;margin-top:20px;color:#757575;font-size:13px">
                                               <b>Respuesta Correcta: </b><em>
                                                 @foreach ($p_vf as $vf)
                                                   @if($todo->codpregunta == $vf->codpregunta)
                                                     @if($vf->correcta == "SI")
                                                       {{$vf->respuesta}}
                                                     @endif
                                                   @endif
                                                 @endforeach
                                               </em>
                                             </div>
                                             @break
                                @endswitch
                              </ul>
                            </nav>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div><!-- /.row -->
          </div>
        </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </section><!-- /.content -->
  </body>
</html>
