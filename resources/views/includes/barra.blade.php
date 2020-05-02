   <!-- Header================================================== -->
    <header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <div id="logo" >
                    <router-link  :to="{name:'inicio'}" ><img src="img/redes/restaurante.png" width="200" height="40" alt="Atena" data-retina="true"></router-link>

                </div>
            </div>
            <nav class="col-md-9 col-sm-9 col-xs-9">
            <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
            <div class="main-menu">
                <div id="header_menu">
                    <router-link class="show-submenu" :to="{name:'inicio'}"><img src="img/redes/restaurante.png" width="200" height="40" alt="Atena" data-retina="true">
</router-link>
                </div>
                <a href="#" class="open_close" id="close_in"><i class="icon_close"></i></a>
                <ul>
                    <li class="submenu">
                        <router-link :to="{name:'inicio'}" class="show-submenu">Inicio</router-link>
                        {{-- <a href="javascript:void(0);" class="show-submenu">Inicio </a> --}}

                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);" class="show-submenu">NOSOTROS <i class="icon-down-open-mini"></i></a>
                        <ul>
                            <li><router-link :to="{name:'about'}">Quienes Somos</router-link></li>
                            <li><router-link :to="{name:'galeria'}">Galería</router-link>
                                </li>

                        </ul>
                    </li>

                    <li class="submenu">
                        <router-link :to="{name:'nuestra-carta'}" class="show-submenu">Nuestra Carta</router-link>
                        {{-- <i href="javascript:void(0);" class="show-submenu">Nuestra Carta <i class="icon-down-open-mini"></i></i> --}}
                        {{-- <ul>
                            <li><a href="about.html">About us</a></li>
                            <li><a href="contacts.html">Plan a visit</a></li>
                            <li><a href="staff.html">Staff</a></li>
                            <li><a href="gallery.html">Gallery</a></li>
                        </ul> --}}
                    </li>
                    {{-- <li><router-link :to="{name:'servicios'}">Servicios</router-link></li> --}}
                   <li class="submenu">
                        <router-link :to="{name:'contacto'}" class="show-submenu">Contáctanos</router-link>
                        {{-- <a href="javascript:void(0);" class="show-submenu">Inicio </a> --}}

                    </li>

                    <li><a href="#" data-toggle="modal" data-target="#login">Ingresar</a></li>
                    <li><a href="#search" id="search_bt"><i class=" icon-search"></i><span>Buscar</span></a></li>
                </ul>
            </div><!-- End main-menu -->
            </nav>
        </div>
    </div><!-- container -->
    </header><!-- End Header -->
