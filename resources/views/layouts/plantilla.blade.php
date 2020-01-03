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
                      www.incanatoit.com - Desarrollando Software
                      <small>www.youtube.com/jcarlosad7</small>
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
              <a href="#">
                <i class="fa fa-print" aria-hidden="true"></i> <input type="button" onclick="window.print()" class="btn btn-danger" name="Imprimir" value="Imprimir">
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
          @yield('content_2')

          <footer class="main-footer">
            <div class="pull-right hidden-xs">
              <b>Version</b> 2.3.0
            </div>
            <strong>Copyright &copy; <script>document.write(new Date().getFullYear());</script> <a href="">DesarrolloIT</a>.</strong> All rights reserved.
          </footer>
          <script src="{{asset('js/preguntas.js')}}"></script>
          <script src="{{asset('js/admin/pregunta.js')}}"></script>
          <script src="{{asset('js/admin/examen.js')}}"></script>
          <script src="{{asset('js/admin/reporte.js')}}"></script>
          <script src="{{asset('js/admin/reporte1.js')}}"></script>
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
