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
  <body class="hold-transition skin-green sidebar-mini" style="font-size: 16px">
    <div class="d-flex justify-content-center">
        <div class="spinner-border text-success" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="{{url('home')}}" class="logo ">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><img src="{{asset('img/conduespoch_sinletras.png')}}" width="40" height="40"></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">CONDUESPOCH E.P.</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <span class="navbar-brand hidden-xs">PERIODO ACADEMICO: {{session('nomperiodo')}}</span>

          <div class="navbar-custom-menu ">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <b class="hidden-xs">
                    <span class="badge badge-warning">{{session('tippersona')}}</span>
                  </b>
                  <span class="hidden-xs">{{session('nombre')}}</span>
                </a>
                <ul class="dropdown-menu ">
                  <!-- User image -->
                  <li class="user-header" >
                    <div class="d-flex justify-content-center">
                      <div class="profile-picture small-profile-picture">
                        <img width="80px" alt="User" src="{{asset('images/users/'.session('foto'))}}">
                      </div>
                    </div>
                    <p>
                      www.condueval.com - Evaluaciones Digitales
                      <small>Conduespoch E.P.</small>
                    </p>
                  </li>

                  <!-- Menu Footer-->
                  <li class="user-footer">

                    <div class="pull-right">
                      <a href="{{route('logout')}}" class="btn btn-default btn-flat">Cerrar</a>
                    </div>
                  </li>
                </ul>
              </li>

            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <ul class="sidebar-menu">
            <li class="header"></li>
            <li class="treeview " style="color:white; font-size:16px">
              <a href="#">
                <i class="fa fa-clock-o"></i>

                @foreach ($examen as $exam)
                    @php
                    $date = date('M j Y H:i:s', strtotime($exam->fechafin));
                    @endphp
                @endforeach
                <div style="display: none">
                  <p id="reloj" >{{$date}} GMT-0500</p>
                </div>
                <span class="text-center">Tiempo Restante:<div id="clock"></div></span>
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h5 class="box-title">
                    @foreach ($examen as $exam)
                      <b>{{$exam->nommateria}}:</b> {{$exam->descripcion}}
                      @php
                        $codexamen = $exam->codexamen;
                      @endphp
                    @endforeach
                  </h5>
                <div class="box-body">
                  	<div class="row form-group">
	                  	<form method="post" action="{{route('guardarintento')}}">
                        @csrf
                        <input type="hidden" name="codexamen" value="{{$codexamen}}">
                        <div class="col-lg-12">
                          @php
                            $i = 0;
                          @endphp
                          @foreach ($todas as $todo)
                            @php
                              $i ++;
                            @endphp
                            <div class="col-lg-12" style="padding-bottom:15px">
                              <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12" >
                                <div class="card" style="width: 100%;">
                                  <div class="card-body" style="padding-top: 3px;padding-bottom: 3px;padding-left: 15px;margin-top: 20px">
                                      <h5 style="font-size: 12px">Pregunta <b style="font-size: 15px">{{$i}}</b></h5>
                                      <h5 style="font-size: 12px">{{$todo->tipo}}</h5>
                                      <h5 style="font-size: 12px">Puntúa como {{$todo->valor}},00 pts.</h5>
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
                                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify" style="float: right;">
                                                        @foreach ($p_unir_enunciado as $unir_e)
                                                          @if($todo->codpregunta == $unir_e->codpregunta)
                                                          <div class="col-lg-6" style="padding-bottom: 20px">{{$unir_e->enunciado}}</div>
                                                          <div class="col-lg-6" style="padding-bottom: 20px">
                                                            <select id="pregunta" name="unir{{$unir_e->codlista}}" class="form-control">
                                                              @foreach ($p_unir_respuesta as $unir_r)
                                                                @if($todo->codpregunta == $unir_r->codpregunta)
                                                                <option>{{$unir_r->respuesta}}</option>
                                                                @endif
                                                              @endforeach
                                                              </select>
                                                            </div>
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
                                                               <input type='text' name="completar{{$completar->codparte}}">&nbsp;
                                                            @endif
                                                          @endif
                                                        @endforeach
                                                      </div>
                                                      @break
                                            @case('SELECCION MULTIPLE')
                                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify">
                                                        @foreach ($p_multiple as $multiple)
                                                          @if($todo->codpregunta == $multiple->codpregunta)
                                                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify" style="padding-bottom: 20px">
                                                            <input type="checkbox" name="smultiple{{$multiple->codrespuesta}}" value="{{$multiple->respuesta}}"> {{$multiple->respuesta}}
                                                          </div>
                                                          @endif
                                                        @endforeach
                                                      </div>
                                                      @break
                                            @case('SELECCION SIMPLE')
                                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify">
                                                        @foreach ($p_simple as $simple)
                                                          @if($todo->codpregunta == $simple->codpregunta)
                                                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify" style="padding-bottom: 20px">
                                                            <input type='radio' name="ssimple{{$todo->codpregunta}}" value='{{$simple->respuesta}}'> {{$simple->respuesta}}
                                                          </div>
                                                          @endif
                                                        @endforeach
                                                      </div>
                                                      @break
                                             @case('VERDADERO FALSO')
                                                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify">
                                                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify" style="padding-bottom: 20px">
                                                           <input type='radio' name="vf{{$todo->codpregunta}}" value='verdadero'> Verdadero
                                                       </div>
                                                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify" style="padding-bottom: 20px">
                                                           <input type='radio' name="vf{{$todo->codpregunta}}" value='falso'> Falso
                                                       </div>
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
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right" style="padding-top: 15px">
                          <input class="btn btn-danger" type="submit" id="guardar_examen_estudiante" name="Guardar" value="Enviar Intento">
                        </div>
                      </form>
                    </div>
                  </div>
                </div><!-- /.row -->
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!-- /.col -->
        </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; <script>document.write(new Date().getFullYear());</script> <a href="">DesarrolloIT</a>.</strong> All rights reserved.
      </footer>

      <!---->
      <div class="loading" id="load"></div>
      <!--Preguntas-->

      <script src="{{asset('js/student/examen.js')}}"></script>
      <script src="{{asset('js/student/countdown.js')}}"></script>

    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    @stack('scripts')
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>

  </body>
</html>
