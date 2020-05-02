<template>
    <div class="animated fadeIn">
       <div class="sub_header bg_4">
        	<div id="intro_txt">


            </div>
		</div> <!--End sub_header -->

        <div id="position" style="position:relative; z-index:-1">
            <div class="container">
                <ul>
                    <li><router-link :to="{name:'nuestra-carta'}">Comienza tu order aqui</router-link></li>
                    <li><a href="#">Categoria</a></li>
                    <li>Página actual</li>
                </ul>
            </div>
        </div><!-- Position -->

    <template v-if="listado==0">
    <div class="contacto" >
        <div class="container margin_60">
            <h2 class="titulo-seccion">Nuestro carta para delivery</h2>
            <div id="tabs" class="container ">

                <div class="tabs" >
                    <div class="tab-seccion">
                        <a v-on:click="activetab=1, tipo = 1, getPlatos(tipo,fecha, cantidad)" v-bind:class="[ activetab === 1 ? 'active' : '' ]" class="text-uppercase">Desayuno</a>
                        <a v-on:click="activetab=2, tipo = 2, getPlatos(tipo,fecha, cantidad)"  v-bind:class="[ activetab === 2 ? 'active' : '' ]" class="text-uppercase">Almuerzo</a>
                        <a v-on:click="activetab=3, tipo = 3, getPlatos(tipo,fecha, cantidad)" v-bind:class="[ activetab === 3 ? 'active' : '' ]" class="text-uppercase">Menu Chifa    </a>
                    </div>
                   <!-- <input type="text" data-provide="datepicker" id="date" v-model="fecha" class="form-control styled" placeholder="Ingrese la fecha"> -->
                   <input style="display:none"  type="date" class="form-control" v-model="fecha" @change="getPlatos(tipo,fecha, cantidad)">
                </div>

                <div class="content ">
                    <div v-if="activetab === 1" class="tabcontent">
                        <div class="row">
                            <div class="col-md-6" v-for="(plato,index) in arrayPlato" :key="plato.id">

                                <div  class="strip_all_courses_list wow fadeIn text-white" data-wow-delay="0.1s">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="img_list">
                                                <a :href="'img/platos/'+plato.imagen" data-lightbox="galeria"><img :src="'img/platos/'+plato.imagen" alt="">
                                                <div class="short_info">
                                                    <h3 class="text-uppercase" >{{plato.nombre}}</h3>
                                                </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="clearfix visible-xs-block">
                                        </div>
                                        <div class="col-lg-5 col-md-5 col-sm-5">
                                            <div class="course_list_desc " style="color: #fff;     line-height: 2;
">
                                                <h3 style="color:#951026; font-weight:bold; font-size:22px"> {{plato.nombre}}</h3>
                                                <p>
                                                Plato de fondo + bebida caliente
                                                </p>
                                               <info-plato></info-plato>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <div class="details_list_col">
                                                <div>
                                                    <p style="font-size:30px; color:#fff" > S/. {{plato.precio}}</p>
                                                    <!-- <a href="academic_single_course.html" class="btn btn-warning ">  ORDENAR</a>
                                                     -->
                                                           <a href="javascript:void(0)" @click="goPedido(index)" class="btn btn-warning">Ordenar</a>
                                                      <!-- <router-link :to="{name:'servicios', params:{plato}}" class="btn btn-warning ">Ordenar</router-link> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--End strip -->

                            </div><!--End col-md-9 -->
                        </div><!--End row -->
                    </div>
                    <div v-if="activetab === 2" class="tabcontent">
                         <div class="row">
                            <div class="col-md-6" v-for="(plato,index) in arrayPlato" :key="plato.id">

                                <div  class="strip_all_courses_list wow fadeIn text-white" data-wow-delay="0.1s">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="img_list">
                                                <a :href="'img/platos/'+plato.imagen" data-lightbox="galeria"><img :src="'img/platos/'+plato.imagen" alt="">
                                                <div class="short_info">
                                                    <h3 class="text-uppercase" >{{plato.nombre}}</h3>
                                                </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="clearfix visible-xs-block">
                                        </div>
                                        <div class="col-lg-5 col-md-5 col-sm-5">
                                            <div class="course_list_desc " style="color: #fff">
                                                <h3 style="color:#951026; font-weight:bold; font-size:22px"> {{plato.nombre}}</h3>
                                                <p>
                                               sopa o entrada + Plato de fondo + {{plato.bebida}}
                                                </p>
                                               <info-plato></info-plato>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <div class="details_list_col">
                                                <div>
                                                    <p style="font-size:30px; color:#fff" > S/. {{plato.precio}}</p>
                                                    <!-- <a href="academic_single_course.html" class="btn btn-warning ">  ORDENAR</a> -->
                                                    <a href="javascript:void(0)" @click="goPedido(index)" class="btn btn-warning">Ordenar</a>
                                                     <!-- <router-link :to="{name:'servicios', params:{plato}}" class="btn btn-warning ">Ordenar</router-link> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--End strip -->

                            </div><!--End col-md-9 -->
                        </div><!--End row -->
                    </div>
                    <div v-if="activetab === 3" class="tabcontent">
                         <div class="row">
                            <div class="col-md-6" v-for="(plato,index ) in arrayPlato" :key="plato.id">

                                <div  class="strip_all_courses_list wow fadeIn text-white" data-wow-delay="0.1s">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="img_list">
                                                <a  :href="'img/platos/'+plato.imagen" data-lightbox="galeria"><img :src="'img/platos/'+plato.imagen" alt="">
                                                <div class="short_info">
                                                    <h3 class="text-uppercase" >{{plato.nombre}}</h3>
                                                </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="clearfix visible-xs-block">
                                        </div>
                                        <div class="col-lg-5 col-md-5 col-sm-5">
                                            <div class="course_list_desc " style="color: #fff">
                                                <h3 style="color:#951026; font-weight:bold; font-size:22px"> {{plato.nombre}}</h3>
                                                <p>
                                                sopa o wantan frito + Plato de fondo + {{plato.bebida}}
                                                </p>
                                                <info-plato></info-plato>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <div class="details_list_col">
                                                <div>
                                                    <p style="font-size:30px; color:#fff" > S/. {{plato.precio}}</p>
                                                    <!-- <router-link :to="{name:'servicios', params:{plato}}" class="btn btn-warning ">Ordenar</router-link> -->
                                                          <a href="javascript:void(0)" @click="goPedido(index)" class="btn btn-warning">Ordenar</a>
                                                    <!-- <a href="academic_single_course.html" class="btn btn-warning " @click="pasarDatos(plato)">  ORDENAR</a> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--End strip -->

                            </div><!--End col-md-9 -->
                        </div><!--End row -->
                    </div>
                </div>
         <div class="text-center">
             <a  v-if="cantidad < 7" @click="cantidad = 12 , getPlatos(tipo,fecha, cantidad)"  class=" button  ">Ver más </a>
             <a  v-if="cantidad > 7" @click="cantidad = 6 , getPlatos(tipo,fecha, cantidad)"  class=" button  ">Ver menos </a>
             </div>
        </div>

            </div><!--End container -->
        </div><!--End container_gray_bg --> <div>

        </div>
    </template>
        <template v-if="listado==1">
            <p class="volver"><a href="javascript:void(0)" @click="volver()"><i class="fas fa-arrow-left"></i> Volver</a></p>
            <carta-pedido :platos="arrayPlato" :indice="indice"></carta-pedido>
        </template>
       <pedido ></pedido>
         <ScrollUp :scroll-duration="1000" />
         <div class="item-fixed">
            <div class="box-orden">
                <a href="javascript:void(0);" @click="modal = 1, eventoModal(modal)" class="button" ><i class=" iconcustom-know_how"></i>
                <p>orden [ {{cantidad_pedido}} ]</p>
                </a>
            </div>
        </div>
    </div>
</template>
<script>
import ScrollUp from 'vue-scroll-up';
import EventBus from '../../event-bus'
import "vue-scroll-up/dist/style.css";
export default {
    components:{
        ScrollUp
    },
    mounted() {
        let me = this;
        me.getPlatos(1, me.getFecha, me.cantidad);
        me.getSopa(me.getFecha);
        me.getEntrada(me.getFecha);
        setTimeout(() => {
            me.mostrarModal();
        }, 1000);

    },
    data() {
        return {
            activetab: 1,
            tipo:1,
            fecha: '',
            cantidad: 6,
            cantidad_pedido:0,
            arrayPlato:[],
            arraySopa:[],
            arrayEntrada:[],
            arrayBebida:[],
            modal:0,
            listado:0,
            indice:0
        }
    },
    computed: {
        getFecha(){
            let me = this;
            var hoy = new Date();
            var dd = hoy.getDate();
            var mm = hoy.getMonth()+1;
            var yyyy = hoy.getFullYear();

            dd = me.addZero(dd);
            mm = me.addZero(mm);

        return me.fecha = yyyy+'-'+mm+'-'+dd;
        },
        getIndice(){
            return this.arrayPlato[this.getIndex()];
        }

    },
    methods: {
        volver(){
            this.listado = 0
        },
        eventoModal(modal){
            if(this.cantidad_pedido == 0){
                Swal.fire({
                    type: 'info',
                        title: 'No tiene pedidos en su Orden',
                }

                )
            }else{

                EventBus.$emit('modal', modal);
            }
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
        addZero(i) {
            if (i < 10) {
                i = '0' + i;
            }
            return i;
        },
        goPedido(indice){
            this.listado =1 ;
            this.indice = indice
            EventBus.$emit('indice',indice)
        },


        mostrarModal(){
            // console.log(this.arraySopa[0]['imagen']);
            let me = this;
                Swal.fire({

                    html:
                        `
                            <h3 style="color:#951026; font-weight:bold; text-transform:uppercase; margin-bottom:20px">Sopa, entrada y bebida del día </h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <img class="img-responsive" src="img/sopas/${me.arraySopa[0]['imagen']}">
                                    <h4>Sopa</h4>
                                </div>
                                <div class="col-md-6">
                                    <img class="img-responsive" src="img/entradas/${me.arrayEntrada[0]['imagen']}">
                                    <h4>Entrada</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">


                                </div>
                                <div class="col-md-6">
                                    <img class="img-responsive" src="img/bebidas/${me.arrayBebida[0]['imagen']}">
                                    <h4>Bebidas</h4>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                        `,



                    // title: 'LOS PLATOS DE ENTRADA DEL DÍA',
                    showConfirmButton: false,
                    timer: 80000
                })
        },
        getSopa(fecha){
            let me = this;
            var url = '/sopa/buscarsopa?fecha='+fecha;
            axios.get(url).then((response) =>{
                // console.log(response);
                var respuesta = response.data;
                me.arraySopa  = respuesta.sopa
            }).catch((error)=>{
                console.log(error)
            })
        },
        getEntrada(fecha){
            let me = this;
            var url = '/entrada/buscarentrada?fecha='+fecha;
            axios.get(url).then((response) =>{
                // console.log(response);
                var respuesta = response.data;
                me.arrayEntrada  = respuesta.entrada;
                me.arrayBebida = respuesta.bebida
            }).catch((error)=>{
                console.log(error)
            })
        }


},
 beforeUpdate() {
     let me = this;

        EventBus.$on('cantidad_pedido', data=>{
        me.cantidad_pedido = data
    })
    EventBus.$on('listado',data=>{
        me.listado = data
    })

    },
}
</script>
<style >
    .swal2-popup{
        padding: 2em!important;
    }
    .item-fixed{
        position: fixed;
        right: 0;
        top: 50%;
        z-index: 100;
        /* background: #f21; */
        padding: 20px 0px;
    }
    .box-orden a{
        padding: 10px 20px;
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
        border-bottom-left-radius: 6px;
        border-top-left-radius: 6px;
        text-align: center;
    }
    .box-orden p{
        margin: 0;
        text-transform: uppercase;
    }
    .box-orden .button i{
        font-size: 45px;
    }
    .volver{
           position: absolute;
        font-size: 25px;
        right: 30px;
        margin-top: -34px;
        font-weight: bold;
    }
    @media (min-width: 767px) {
        .volver{
            right: 40px;
        }

    }
    @media (min-width: 1777px) {
        .volver{
            right: 425px;
        }
    }

</style>
