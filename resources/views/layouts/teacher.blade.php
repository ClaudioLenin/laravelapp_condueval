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
  <body class="hold-transition skin-green sidebar-mini">
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
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <span class="navbar-brand hidden-xs">PERIODO ACADEMICO: {{session('nomperiodo')}}</span>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu ">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->

              <!-- User Account: style can be found in dropdown.less -->
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
            <li class="treeview">
              <a href="{{route('profileteacher')}}">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span>Datos de usuario</span>
              </a>
            </li>
            <li class="treeview">
              <a href="{{url('teacher/pregunta')}}">
                <i class="fa fa-list-alt"></i>
                <span>Ingreso de Preguntas</span>
              </a>
            </li>
            <li class="treeview">
              <a href="{{url('teacher/examen')}}">
                <i class="fa fa-file-text-o"></i>
                <span>Ingreso de Evaluación</span>
              </a>
            </li>
            <li class="treeview">
              <a href="{{url('teacher/reporte')}}">
                <i class="fa fa-line-chart"></i>
                <span>Reportes</span>
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
                  <h3 class="box-title">Sistema de Evaluaciones</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

<!--                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
		                          <!--Contenido-->
                              @yield('content_3')
		                          <!--Fin Contenido-->
                           </div>
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

      <div class="loading" id="load"></div>

      <!--Preguntas-->
      <script src="{{asset('js/preguntas.js')}}"></script>
      <script src="{{asset('js/teacher/pregunta.js')}}"></script>

      <script src="{{asset('js/teacher/examen.js')}}"></script>
      <script src="{{asset('js/teacher/reporte.js')}}"></script>
      <script src="{{asset('js/teacher/reporte1.js')}}"></script>
      <script src="{{asset('js/teacher/reporte2.js')}}"></script>
      <script src="{{asset('js/teacher/reporte3.js')}}"></script>
      <script src="{{asset('js/teacher/reporte4.js')}}"></script>
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
