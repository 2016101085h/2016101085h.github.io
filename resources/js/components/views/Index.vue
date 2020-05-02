<template>
    <div class="animated fadeIn">
         <section class="header-video">
            <div id="hero_video">
                <div id="intro_txt" >
                    <h1 class="animated fadeInDown">Restaurante <strong>Los</strong> Ángeles</h1>

                    <router-link :to="{name:'nuestra-carta'}" class="animated fadeInUp button_intro">Nuestra Carta</router-link>
                    <router-link :to="{name:'about'}" class="animated fadeInUp button_intro outline hidden-sm hidden-xs">Nosotros</router-link>
                    <!-- <a href="#" class="animated fadeInUp button_intro outline hidden-sm hidden-xs">View courses</a> -->
                    <a  href="https://vimeo.com/20370747" class="video_pop animated fadeInUp button_intro outline">Play video</a>
            </div>
            </div>
                <img src="img/video_fix.png" alt="" class="header-video--media" data-video-src="video/intro"  data-teaser-source="video/intro" data-provider="Vimeo" data-video-width="1920" data-video-height="960">
        </section><!-- End Header video -->



        <enlace></enlace>

    <div class="container margin_60 ">
        <features></features>

            <div class="text-center"><router-link :to="{name:'contacto'}" class=" button large">Contáctanos</router-link></div>
    </div><!-- End container -->






        <div class="carta-dia">
            <div class="container-fluid margin_60">
          <div class="main_title">
                <h2 class="titulo-seccion">Comienza tu orden aquí EN NUESTRA CARTA</h2>
                <p>Buscamos darte ese deleite a través de nuestras diferentes especialidades</p>

            </div>
            <div id="tabs" class="container ">

                <div class="tabs" style="justify-content:center; flex-direction:row">
                    <a v-on:click="activetab=1, tipo=1, getPlatos(tipo, fecha, cantidad)" v-bind:class="[ activetab === 1 ? 'active' : '' ]" class="text-uppercase">Desayuno</a>
                    <a v-on:click="activetab=2, tipo=2, getPlatos(tipo, fecha, cantidad)" v-bind:class="[ activetab === 2 ? 'active' : '' ]" class="text-uppercase">Almuerzo</a>
                    <a v-on:click="activetab=3, tipo=3, getPlatos(tipo, fecha, cantidad)" v-bind:class="[ activetab === 3 ? 'active' : '' ]" class="text-uppercase">Menu Chifa    </a>
                </div>

                <div class="content">
                    <div v-if="activetab === 1" class="tabcontent">
                        <div class=" row">
                                <div class="col-md-3" v-for="plato in arrayPlato" :key="plato.id">
                                 <div class="contenedor-platos">
                                    <div class="plato-contenedor ">

                                        <img :src="'img/platos/'+plato.imagen" alt="">

                                    <p><a :href="'img/platos/'+plato.imagen" data-lightbox="galeria"><i class=" icon-search"></i>

                                    </a></p>
                                </div>
                                <div class="nombre-plato"><p>{{plato.nombre}}</p></div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="activetab === 2" class="tabcontent">
                            <div class=" row">
                                <div class="col-md-3" v-for="plato in arrayPlato" :key="plato.id">
                                 <div class="contenedor-platos">
                                    <div class="plato-contenedor ">

                                        <img :src="'img/platos/'+plato.imagen" alt="">

                                    <p><a :href="'img/platos/'+plato.imagen" data-lightbox="galeria"><i class=" icon-search"></i>

                                    </a></p>
                                </div>
                                <div class="nombre-plato"><p>{{plato.nombre}}</p></div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="activetab === 3" class="tabcontent">
                            <div class=" row">
                                <div class="col-md-3" v-for="plato in arrayPlato" :key="plato.id">
                                 <div class="contenedor-platos">
                                    <div class="plato-contenedor ">

                                        <img :src="'img/platos/'+plato.imagen" alt="">

                                    <p><a :href="'img/platos/'+plato.imagen" data-lightbox="galeria"><i class=" icon-search"></i>

                                    </a></p>
                                </div>
                                <div class="nombre-plato"><p>{{plato.nombre}}</p></div>
                              </div>
                            </div>
                        </div>
                    </div>
                    </div>
            <div class="text-center"><router-link :to="{name:'nuestra-carta'}" class=" button ">Ver más Detalles </router-link></div>
            </div>

    </div>
        </div>
  <div  class="servicios_bg margin_60">
            <servicios ></servicios>
        </div>

    <div class="bg_content magnific">
            <div>

                <a href="https://vimeo.com/20370747" class="video_pop"><i class="arrow_triangle-right_alt2"></i></a>
            </div>
        </div><!-- End bg_content -->

        <div class="container_gray_bg" id="newsletter_container">
        <div class="container margin_60">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <h3 class="titulo-seccion">Ver nuestra carta digital</h3>
                    <!-- <div id="message-newsletter"></div>
                    <form method="post" action="assets/newsletter.php" name="newsletter" id="newsletter" class="form-inline mt-5">
                        <input name="email_newsletter" id="email_newsletter" type="email" value="" placeholder="Your Email" class="form-control">
                        <button id="submit-newsletter" class="button"> Subscribe</button>
                    </form> -->
                </div>
            </div>
        </div>
        </div><!-- End newsletter_container -->
        <ScrollUp :scroll-duration="1000" />
    </div>
</template>
<script>
import ScrollUp from 'vue-scroll-up';
import "vue-scroll-up/dist/style.css";


export default {
    name: 'app',
    components:{
        ScrollUp,

    },
    data() {
        return {
            activetab: 1,
            arrayPlato:[],
            fecha:'',
            cantidad:4,
            tipo:1

        }
    },

    mounted() {
        this.cargarDoom();
        this.getPlatos(1, this.getFecha, this.cantidad);
    },

     methods:{
         cargarDoom(){
             $(document).ready(function() {
                'use strict';
            HeaderVideo.init({
                container: $('.header-video'),
                header: $('.header-video--media'),
                videoTrigger: $("#video-trigger"),
                autoPlayVideo: false
                });


            });
         },
         addZero(i) {
            if (i < 10) {
                i = '0' + i;
            }
            return i;
        },
              getPlatos(tipo, fecha, cantidad ){
            let me = this;
            var url = '/plato/platoservicio?tipo='+tipo+'&fecha='+fecha+'&cantidad='+cantidad;
            axios.get(url).then((response)=>{
                // console.log(response);
                var respuesta = response.data;
                me.arrayPlato = respuesta.plato
            }).catch((error)=>{
                console.log(error)
            })
        },


     },
      computed: {
        getFecha(){
            var hoy = new Date();
            var dd = hoy.getDate();
            var mm = hoy.getMonth()+1;
            var yyyy = hoy.getFullYear();

            dd = this.addZero(dd);
            mm = this.addZero(mm);

        return this.fecha = yyyy+'-'+mm+'-'+dd;
        },


    },
}
</script>
<style >
    .vue-scroll-up{
        bottom: 20px!important;
        background-color: rgb(149, 16, 38)!important;
        right: 20px!important;
    }
    /* .tabs{
        display: flex;
        justify-content: center;
    } */
    .contenedor-platos{
               -webkit-box-shadow: 3px 3px 44px -16px rgba(0,0,0,0.75);
        -moz-box-shadow: 3px 3px 44px -16px rgba(0,0,0,0.75);
        box-shadow: 3px 3px 44px -16px rgba(0,0,0,0.75);
        overflow: hidden;
        border-radius:10px ;
        margin-bottom: 25px;


    }

    .plato-contenedor{
        /* border: 1px solid #d1d1d1; */
        /* border-bottom: 5px solid #C35164; */


        transition: all .5s ease-in-out;
        position: relative;

        overflow: hidden;

    }
    .plato-contenedor img{
        width: 100%;
        padding: 0;
        transform: scale(1.1);
        transition: all .5s ease-in-out;

    }

    .plato-contenedor p{
        padding: 20px;
        position: absolute;
        background: rgba(0, 0, 0, 0.431);
        bottom: -650px;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        line-height: 50%;
        font-size: 50px;
        color: #000;
        transition: all .5s ease-in-out;
        overflow: hidden;
    }

    .plato-contenedor:hover img{
        transform: scale(1);
        opacity: 1;

    }
    .plato-contenedor:hover p{
        bottom: 0;

    }
    .nombre-plato{
        border-radius: none!important ;
    }
     .nombre-plato p{
         background: rgb(149, 16, 38);
         text-align: center;
         padding: 5px  ;
         margin: 0;
         text-transform: capitalize;
         color: #fff;
         font-family: 'Baloo Paaji 2';
         font-size: 22px;
         font-weight: bold;

    }
</style>
