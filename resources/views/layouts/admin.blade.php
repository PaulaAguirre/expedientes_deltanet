<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DocF | DCingeniería </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">


    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('img/lupa.png')}}" >

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">

        <!-- Logo -->
        <a href="{{url ('index_exp')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>DF</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>DocF</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Navegación</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Notifications <span class="badge">{{count(Auth::user()->unreadNotifications)}}</span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                @foreach (Auth::user()->unreadNotifications as $notification)
                                    @if($notification->type == 'App\Notifications\NuevoPendienteNotification')
                                        <a href="{{$notification->data['link']}}">{{$notification->data['text']}} <button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                    @endif

                                    @if($notification->type == 'App\Notifications\RechazadosNotification')
                                        <a href="{{$notification->data['link']}}">{{$notification->data['text']}}"> <button class="btn btn-danger btn-xs"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                    @endif
                                @endforeach
                            </li>
                        </ul>
                    </li>

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <small class="bg-aqua">Online</small>
                            <span class="hidden-xs"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <!-- User image -->
                            @if(Auth::check ())

                                <li class="user-header">

                                    <p class="text-bold text-uppercase">
                                            {{ Auth::user()->name }} {{Auth::user ()->lastname}} <br>

                                        @if(in_array (Auth::user ()->role_id, [1,2]))
                                            <small class="text-yellow">Administrador</small>
                                        @elseif(Auth::user ()->role_id == 8 && !Auth::user ()->funcionario () && !Auth::user ()->area ())
                                            <small class="text-yellow">User</small>
                                        @elseif(Auth::user ()->area || Auth::user ()->funcionario)
                                            <small class="text-yellow">
                                                {{Auth::user ()->funcionario ? Auth::user ()->funcionario->departamento->nombre : Auth::user ()->area->nombre}}
                                            </small>
                                        @endif

                                            <br>
                                                <span class="fa fa-users"></span>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer" style="background-color: #a6e1ec">

                                    <div class="pull-right">
                                        <a class="btn btn-info" href="/users/{{auth ()->id ()}}/edit">Mi cuenta</a>

                                        <a class="btn btn-danger" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            Cerrar Sesion
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>

                                    </div>
                                </li>
                            @endif
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
            <!-- Sidebar user panel -->

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header"></li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-list-alt" aria-hidden="true"></i>
                        <span>Administración</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        @if(in_array (Auth::user ()->role_id, [1,2,3] ))
                        <li><a href="{{url('roles')}}"><i class="fa fa-book"></i> Roles</a></li>
                        @endif
                        <li><a href="{{url('users')}}"><i class="fa fa-book"></i> Users</a></li>
                            <li><a href="{{url ('ots')}}"><i class="fa fa-book"></i>OTs</a></li>
                        <li><a href="{{url('gerencias')}}"><i class="fa fa-book"></i> Gerencias</a></li>
                        <li><a href="{{url('departamentos')}}"><i class="fa fa-book"></i> Departamentos</a></li>
                        <li><a href="{{url ('funcionarios')}}"><i class="fa fa-book"></i> Funcionarios</a></li>
                        <li><a href="{{url('proveedores')}}"><i class="fa fa-book"></i> Proveedores</a></li><li><a href="{{url('tipoexpedientes')}}"><i class="fa fa-book"></i> Tipos de Expedientes</a></li>

                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-archive"></i>
                        <span>Expedientes</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('expedientes')}}"><i class="fa fa-folder"></i>Mis Expedientes Creados</a></li>
                        <li><a href="{{url('expedientes_rechazados/expedientes_rechazados_creador')}}"><i class="fa fa-folder"></i>Mis Expedientes Rechazados</a></li>
                        @if(in_array (Auth::user ()->role_id, [1,2,3] ))
                            <li><a href="{{url ('aprobacion_expedientes/expedientes_pendientes')}}"><i class="fa fa-folder"></i>Expedientes a Aprobar</a></li>
                            <li><a href="{{url ('expedientes_por_areas')}}"><i class="fa fa-folder"></i>Expedientes por Areas</a></li>
                        @endif
                    </ul>
                </li>

                <li class="treeview">
                    <a href="">
                        <i class="fa fa-folder"></i> <span>Acceso</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/users/{{auth ()->id ()}}/edit"><i class="fa fa-user"></i>Mi Cuenta</a></li>

                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                        <small class="label pull-right bg-red">PDF</small>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                        <small class="label pull-right bg-yellow">IT</small>
                    </a>
                </li>

            </ul>

            
        </section>
        <!-- /.sidebar -->
        <br>
        <br>
        <img src="{{URL::asset('/img/logo2.png')}}" class="margin text-center" style="width: 90%">

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
                            <h3 class="box-title text-blue">Gestión Electrónica de Expedientes</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <!--Contenido-->
                                    @yield('contenido')
                                    <!--Fin Contenido-->
                                </div>
                            </div>

                        </div>
                    </div><!-- /.row -->
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </section>
    </div><!-- /.col -->
</div><!-- /.row -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!--Fin-Contenido-->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version.</b> Beta
    </div>
    <strong>Copyright &copy; 2018<span> <img src="{{URL::asset('/img/logo deltanet.png')}}" style="width: 2%"></span> <a href="">DELTAnet.</a>.</strong> All rights reserved.
</footer>


<!-- jQuery 2.1.4 -->
<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
@stack('scripts')

<!-- Bootstrap 3.3.5 -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/bootstrap-select.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{asset('js/app.min.js')}}"></script>

</body>
</html>
