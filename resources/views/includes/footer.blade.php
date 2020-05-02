
        <div id="copy">
            <div class="container">
                 © Restaurante - Hostal " LOS ÁNGELES" {{date('Y')}} - Todos los derechos reservados.
            </div>
        </div><!-- End copy -->

<!-- Login modal -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myLogin" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content modal-popup">
				<a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
                <form action="{{ route('login')}}" method="post" class="popup-form" id="myLogin">
                     {{ csrf_field() }}
                    <div>
                        <img src="img/redes/logo1.png" alt="" class="img-responsive">
                    </div>
                    <input type="text" value="{{old('usuario')}}" class="form-control form-white" name="usuario" placeholder="Nombre de usuario">
                    {!!$errors->first('usuario','<span style="color:#fff!important"  class="invalid-feedback">:message</span>')!!}
                    <input type="password" class="form-control form-white" name="password" placeholder="Contraseña">
                    {!!$errors->first('password','<span  style="color:#fff!important" class="invalid-feedback">:message</span>')!!}
					{{-- <div class="checkbox-holder text-left">
						<div class="checkbox">
							<input type="checkbox" value="accept_1" id="check_1" name="check_1" />
							<label for="check_1"><span>I Agree to the <strong>Terms &amp; Conditions</strong></span></label>
						</div>
					</div> --}}
					<button type="submit" class="btn btn-submit">Ingresar</button>
				</form>
			</div>
		</div>
	</div>

<!-- Register modal -->
<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="myRegister" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content modal-popup">
				<a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
				<form action="#" class="popup-form" id="myRegister">
                       <div>
                        <img src="img/redes/logo1.png" alt="" class="img-responsive">
                    </div>
					<input type="text" class="form-control form-white" placeholder="Name">
					<input type="text" class="form-control form-white" placeholder="Last Name">
                    <input type="email" class="form-control form-white" placeholder="Email">
                    <input type="text" class="form-control form-white" placeholder="Password">
					<div class="checkbox-holder text-left">
						<div class="checkbox">
							<input type="checkbox" value="accept_2" id="check_2" name="check_2" />
							<label for="check_2"><span>I Agree to the <strong>Terms &amp; Conditions</strong></span></label>
						</div>
					</div>
					<button type="submit" class="btn btn-submit">Register</button>
				</form>
			</div>
		</div>
	</div>

<!-- Search modal -->
<div id="search">
    <button type="button" class="close">×</button>
    <form>
        <input type="search" value="" placeholder="Ingrese lo que quiere buscar" >
        <button type="submit" class="button">Search</button>
    </form>
</div>

<!-- Common scripts -->
{{-- <script src='./vue-scroll-up.js'></script> --}}
<script src="js/app.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/common_scripts_min.js"></script>
{{-- <script src="js/bootstrap.js"></script> --}}
<script src="administracion/js/sweetalert2.js"></script>
<script src="js/jquery.magnific-popup.js"></script>
<script src="js/lightbox.js"></script>
<script src="js/functions.js"></script>
<script src="layerslider/js/greensock.js"></script>
 <script src="layerslider/js/layerslider.transitions.js"></script>
<script src="layerslider/js/layerslider.kreaturamedia.jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
		'use strict';
        $('#layerslider').layerSlider({
            autoStart: true,
			responsive: true,
			responsiveUnder: 1280,
			layersContainer: 1170,
            skinsPath: 'layerslider/skins/'
            // Please make sure that you didn't forget to add a comma to the line endings
            // except the last line!
        });

    });

</script>
<script>
      $(document).ready(function(){
        $('#modalInicio').modal('show');
    })
</script>





  <script src="js/video_header.js"></script>
<script>

</script>
</body>
</html>
