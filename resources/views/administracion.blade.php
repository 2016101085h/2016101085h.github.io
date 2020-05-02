@include('administracion/header')
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <div id="app">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Escritorio</a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contacto</a>
      </li> --}}
    </ul>

    <!-- SEARCH FORM -->
    {{-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> --}}

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      {{-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" data-target="#mensaje">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="mensaje">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="img/usuario/{{Auth::user()->imagen}}  " alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="administracion/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="administracion/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li> --}}
      <notificacion  :notificacion="notificacion"></notificacion>
       <!-- User Account: style can be found in dropdown.less -->

       <li class=" user-menu nav-item dropdown mt-2 ml-3">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-target="#sesion">
           <img src="img/usuario/{{Auth::user()->imagen}}" class="user-image" alt="User Image">
           <span class="text-dark">{{Auth::user()->nombre.' '.Auth::user()->apellido}}</span>
         </a>

         <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="sesion">
           <!-- User image -->
           <li class="user-header">
             <img src="img/usuario/{{Auth::user()->imagen}}" class="img-circle" alt="User Image">

             <p>
               {{Auth::user()->nombre.' '.Auth::user()->apellido}} - Desarrollador Web
             <small>Miembro desee {{now()}}</small>
             </p>
           </li>

           <!-- Menu Footer-->
           <li class="user-footer">
             <div class="pull-left">
               <a href="#" class="btn btn-info float-left">Profile</a>
             </div>
             <div class="pull-right">
                    <a href="{{ route('logout')}} " onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-danger  float-right"><i class="fa fa-sign-out"></i> Cerrar Sesión</a>

                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     {{ csrf_field() }}
             </form>
           </li>
         </ul>
       </li>
{{--
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li> --}}
    </ul>
  </nav>
  <!-- /.navbar -->

  @include('administracion/sidebar')
  @yield('contenido')


   <!--Fin del modal-->
   <!-- Inicio del modal Eliminar -->
   <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     style="display: none;" aria-hidden="true">
     <div class="modal-dialog modal-danger" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h4 class="modal-title">Eliminar Categoría</h4>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">×</span>
           </button>
         </div>
         <div class="modal-body">
           <p>Estas seguro de eliminar la categoría?</p>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
           <button type="button" class="btn btn-danger">Eliminar</button>
         </div>
       </div>
       <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
   </div>
   <!-- Fin del modal Eliminar -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.0-beta.1
    </div>
    <strong>Copyright &copy; {{date('Y')}} <a href="http://adminlte.io">LOS ÁNGELES</a>.</strong> Todos los derechos reservados
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
</div>
<!-- ./wrapper -->
<script src="js/app.js"></script>
<!-- jQuery -->
<script src="administracion/plugins/jquery/jquery.min.js"></script>
<script src="administracion/js/sweetalert2.js"></script>
<!-- Bootstrap 4 -->
<script src="administracion/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- FastClick -->
<script src="administracion/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="administracion/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="administracion/js/demo.js"></script>
<script>
       $('.nav .nav-item .nav-link').click(function(){
        $('.nav .nav-item .nav-link').removeClass('active')
        if(!$(this).hasClass('active')){
            $(this).addClass('active')
        }else{
            $(this).removeClass('active')
        }


    })
</script>
</body>
</html>
