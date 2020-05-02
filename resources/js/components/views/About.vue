<template>
    <div class="animated fadeIn">

    <slider></slider>


 		<div class="about_bg_init">
        <div class="container margin_60 ">
        <div class="main_title">
            <h2 class="titulo-seccion">Porque Elegirnos</h2>
            </div>

        	<div class="row " style="margin-top:78px">
                 <div class="col-md-4 col-sm-4">
            	<a class="box_feat" href="#">
                <i class="pe-7s-science"></i>
            	<h3>Asesoría Profesional</h3>
                <p>Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris, cum no alii option, cu sit mazim libris.</p>
            </a>
            </div>
        	<div class="col-md-4 col-sm-4">
            	<a class="box_feat" href="#">
                <i class="pe-7s-diamond"></i>
            	<h3>Capacitación de Calidad</h3>
                <p>Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris, cum no alii option, cu sit mazim libris.</p>
            </a>
            </div>
            <div class="col-md-4 col-sm-4">
            	<a class="box_feat" href="#">
                <i class="pe-7s-display2"></i>
            	<h3>Equiped class rooms</h3>
                <p>Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris, cum no alii option, cu sit mazim libris. </p>
            </a>
            </div>

            </div><!--End row-->

            <div class="row">
            <div class="col-md-4 col-sm-4">
            	<a class="box_feat" href="#">
                <i class="pe-7s-rocket"></i>
            	<h3>Transparencia</h3>
                <p>La gestión de la empresa se rige con las normatividades y las legalidades que regulan el estado, asimismo se brinda información de excelencia al colaborador y al cliente.</p>
            </a>
            </div>
        	<div class="col-md-4 col-sm-4">
            	<a class="box_feat" href="#">
                <i class="pe-7s-target"></i>
            	<h3>Organización</h3>
                <p>Se tiene una buena comunicación y compromiso por parte de los colaboradores. Así mismo se organiza constantemente las áreas de trabajo aplicando la mejora continua.</p>
            </a>
            </div>
            <div class="col-md-4 col-sm-4">
            	<a class="box_feat" href="#">
                <i class="pe-7s-graph1"></i>
            	<h3>Focus en el Exito</h3>
                <p>Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris, cum no alii option, cu sit mazim libris. </p>
            </a>
            </div>
            </div><!--End row-->


        </div><!--End container -->
        </div><!--End bg_gray_container -->

        <div class="info_about">
            <div class="container margin_60">
        	<div class="main_title">
                <h2 class="titulo-seccion">RESTAURANTE LOS ÁNGELES</h2>

            </div>
             <div class="row">
                    <div  class="mision">
                    <div class="  box_mision_vision text-center">
                        <h4>Missión</h4>
                        <img src="img/gallery/mision.jpg" class="img-responsive"  alt="">
                        <p>Brindar servicios de capacitación, consultoría y construcción en el rubro de ingeniería a estudiantes y profesionales dentro de la región centro en los plazos y presupuestos establecidos, todo en base a la experiencia y excelencia profesional.
                        </p>

                    </div>
                    <div class="col-md-2 col-sm-2"></div>
                    <div class= " box_mision_vision text-center">
                        <h4>Visión</h4>
                        <img src="img/gallery/mision.jpg" class="img-responsive" alt="">
                        <p>
Ser una de las empresas de mayor competencia y líder de la región centro para el 2020, superando las espectativas y excelencia en cuanto a los servicios que se brinda en los rubros de la construcción, capacitacion, ingeniería y gestión de proyectos, satisfaciendo y agregando valor a las necesidades de los clientes constantemente.                        </p>

                    </div>
                </div>
                </div>




            <div class="row text-center" style="color:white">
             <h2 class="text-center mb-1 titulo-seccion" >PRINCIPIOS</h2>
            	<div class="col-md-4 col-sm-4">
                	<p><img src="img/gallery/puntualidad.jpg" alt="" class="img-responsive"></p>
                	<h4 style="color:darkgray" >Puntualidad</h4>
                </div>
                <div class="col-md-4 col-sm-4">
                	<p><img src="img/gallery/transparencia.jpg" alt="" class="img-responsive"></p>
                	<h4 style="color:darkgray">Transparencia</h4>
                </div>
                <div class="col-md-4 col-sm-4">
                	<p><img src="img/gallery/organizacion.jpg" alt="" class="img-responsive"></p>
                	<h4 style="color:darkgray">Organización</h4>
                </div>
            </div><!--End row -->
        </div><!--End container -->
        </div>



        <ScrollUp :scroll-duration="1000" />


 </div>
</template>
<script>
import ScrollUp from 'vue-scroll-up';
import "vue-scroll-up/dist/style.css";
export default {
    data() {
        return {

        }
    },
    components:{
        ScrollUp
    },
    methods: {
        cargarDoom(){
          $('#layerslider').layerSlider({
            autoStart: true,
			responsive: true,
			responsiveUnder: 1280,
			layersContainer: 1170,
            skinsPath: 'layerslider/skins/'
            // Please make sure that you didn't forget to add a comma to the line endings
            // except the last line!
        });

        }
    },
    mounted(){
        this.cargarDoom();
    }
}
</script>
