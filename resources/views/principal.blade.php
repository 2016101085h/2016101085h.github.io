@include('includes/header')

 <div id="app">
    @include('includes/barra')
    <router-view></router-view>

    <div class="widget">
       <div class="contenedor-widget">
           <a href=""> <img src="img/redes/whatsapp1.png" class="animated fadeIn" alt=""></a>
       </div>
    </div>
    <div class="container">
  <!-- Trigger the modal with a button -->

  <!-- Modal -->
  <div class="modal fade" id="modalInicio" role="dialog">
    <div class="modal-dialog" >

      <!-- Modal content-->
      <div class="modal-content modalInicio">
           <button type="button" class="close boton-cerrar" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>

    </div>
  </div>

</div>
    <footer :class="{'footer': modalabierto == 1}">
        <div class="container">
            <div class="row ">

                <div class="col-md-4 col-sm-4">
                    <h4>Acerca de</h4>
                    <ul>
                        <li>
                            <router-link :to="{name:'about'}">Nosotros</router-link></li>
                       <li><router-link :to="{name:'nuestra-carta'}">Nuestra Carta</router-link></li>
                        <li><a href="#" data-toggle="modal" data-target="#login">Login</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#register">Register</a></li>
                        <li><a href="#">Terminos y condiciones</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-4 text-center">
                      <p id="logo_footer">
                        <router-link :to="{name:'inicio'}"><img src="img/redes/restaurante.png" width="190" height="40" alt="Atena" data-retina="true"> </router-link>
                    </p>
                   <p>Huancayo : Avenida Evitamiento 581 - El Tambo</p>
                   <p>(064) 999999</p>
                   <p>9575485496</p>
                   <p><img src="img/redes/visa.jpg" width="15%" alt="">
                    <img src="img/redes/master.jpg"  width="15%"alt="">
                </p>
                </div>
                <div class="col-md-4 col-sm-4 text-right">
                    <h4>Contáctanos</h4>
                    <ul>
                        <li><router-link :to="{name:'contacto'}">Contacto</router-link></li>
                        {{-- <li><a href="#">Plan a visit</a></li> --}}
                    </ul>
                    <ul id="contacts_footer">

                        <li>Correo Electrónico - <a href="#">heracledis12@gmail.com</a> / <a href="#">heracledis12@gmail.com</a></li>
                    </ul>
                    <div class="row text-center">

                            <a href="#"  target="_blank"><img src="img/redes/face.svg" class="size-sociales-f opacity-sociales-f" alt="Facebook"></a>
                            <a href="#" target="_blank"><img src="img/redes/gorjeo.svg" class="size-sociales-f opacity-sociales-f" alt="Twitter"></a>
                            <a href="#" target="_blank"><img src="img/redes/yt.svg" class="size-sociales-f opacity-sociales-f" alt="Youtube"></a>

                    </div>
                </div>
            </div><!-- End row -->
        </div><!-- End container -->
        </footer><!-- End footer -->
 </div>

    @include('includes/footer')
