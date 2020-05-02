<template>

 		<div class="carta">
        <div class="container padding_30">
            <div class="main_title">
                <h2 class="titulo-seccion" style="margin-top:20px">Personaliza tu Pedido</h2>
                <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>

            </div>
            <div class="row">

                        <div class="box_style_1" >


                                   <div class="row">
                                    <div class="col-md-6" style="margin-bottom:15px">
                                    <img class="img-responsive" :src="'img/platos/'+Plato[index]['imagen']" :class="{'desayuno_img': Plato[index]['tipo'] == 'Desayuno', 'almuerzo_img': Plato[index]['tipo'] == 'Almuerzo',
                                    'chifa_img': Plato[index]['tipo'] == 'Menu chifa'}"  >
                                </div>
                                <div class="col-md-6">
                                    <template v-if="Plato[index]['tipo'] == 'Desayuno'">

                                          <div>
                                            <div class="info-plato">
                                                <h3>{{Plato[index]['nombre']}} </h3>
                                                <p style="font-weight:bold">S/. {{Plato[index]['precio']}}</p>
                                            </div>
                                            <div class="row" style="font-size:16px; font-style:italic">
                                                <div class="col-md-8">
                                                     Plato de fondo + Bebida caliente
                                                </div>
                                                <div class="col-md-4">


                                                </div>
                                            </div>
                                        </div>
                                           <hr class="style_2">
                                        <div>
                                            <label for="" class="label-pedido">Seleccione Bebida caliente </label>
                                            <div class="pedido-sopa-entrada">
                                                    <div class="custom-control custom-radio">
                                                    <input  type="radio" id="te" v-model=entrada value="te" class="custom-control-input">
                                                    <label class="custom-control-label" for="te">Té</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="cafe" v-model=entrada value="cafe" class="custom-control-input">
                                                    <label class="custom-control-label" for="cafe">Café</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="anis" v-model=entrada value="anis" class="custom-control-input">
                                                    <label class="custom-control-label" for="anis">Anís</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="quiaquer" v-model=entrada value="quiaquer" class="custom-control-input">
                                                    <label class="custom-control-label" for="quiaquer">Quaquer</label>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                    <template v-if="Plato[index]['tipo'] == 'Menu chifa'">
                                            <div>
                                            <div class="info-plato">
                                                <h3>{{Plato[index]['nombre']}} </h3>
                                                <p style="font-weight:bold">S/. {{Plato[index]['precio']}}</p>
                                            </div>
                                            <div class="row" style="font-size:16px; font-style:italic">
                                                <div class="col-md-8">
                                                    sopa + Wantan frito + refrezco
                                                </div>
                                                <div class="col-md-4">


                                                </div>
                                            </div>
                                        </div>

                                        <hr class="style_2">
                                        <div>
                                            <label for="" class="label-pedido">Seleccione sopa </label>
                                            <div class="pedido-sopa-entrada">
                                                    <div class="custom-control custom-radio">
                                                    <input type="radio" id="sopa-pollo" v-model=entrada value="sopa-pollo" class="custom-control-input">
                                                    <label class="custom-control-label" for="sopa-pollo">Sopa de Pollo</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="sopa-wantan" v-model=entrada value="sopa-wantan" class="custom-control-input">
                                                    <label class="custom-control-label" for="sopa-wantan">Sopa wantan</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="sopa-kion" v-model=entrada value="sopa-kion" class="custom-control-input">
                                                    <label class="custom-control-label" for="sopa-kion">Sopa de kion</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="wantan-frito" v-model=entrada value="wantan-frito" class="custom-control-input">
                                                    <label class="custom-control-label" for="wantan-frito">Wantan frito</label>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                    <template v-if="Plato[index]['tipo'] == 'Almuerzo'">
                                            <div>
                                            <div class="info-plato">
                                                <h3>{{Plato[index]['nombre']}} </h3>
                                                <p style="font-weight:bold">S/. {{Plato[index]['precio']}}</p>
                                            </div>
                                            <div class="row" style="font-size:16px; font-style:italic">
                                                <div class="col-md-8">
                                                    sopa o entrada + Plato de fondo + refrezco
                                                </div>
                                                <div class="col-md-4">


                                                </div>
                                            </div>
                                        </div>

                                        <hr class="style_2">
                                        <div>
                                            <label for="" class="label-pedido">Seleccione sopa o Entrada</label>
                                            <div class="pedido-sopa-entrada">
                                                <div class="custom-control custom-radio">
                                                <input type="radio" id="sopa" v-model=entrada value="sopa" class="custom-control-input">
                                                <label class="custom-control-label" for="sopa">Sopa</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="entrada" v-model=entrada value="entrada" class="custom-control-input">
                                                    <label class="custom-control-label" for="entrada">Entrada</label>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                    <div class="comentario-pedido">
                                        <label class="label-pedido" for="">Comentario (Opcional)</label>
                                        <textarea class="form-control" v-model="comentario" style="background:transparent" cols="10"></textarea>
                                            <!-- <div v-show="errorPedido" class="form-group row div-error m-0">
                                            <div class="text-center text-error" style="margin: 20px 0 0 0;   font-size: 18px;color:#951026!important">
                                                    <div v-for="error in errorMsjPedido" :key="error" v-text="error">

                                                    </div>

                                                </div>
                                </div> -->
                                        <!-- <textarea name="" id="" cols="30" rows="10"></textarea> -->
                                    </div>
                                    <hr class="style_3">

                                    <div class="carta-pedido">
                                        <div  class="cantidad-pedido">
                                            <div>
                                                    <label for=""  class="label-pedido" style="display:block; margin-bottom:10px">Cantidad</label>
                                                   <div class="boton-cantidad">
                                                        <a  href="javascript:void(0)" :class="{'isDisabled':cantidad == 1}" @click="cantidad--"  disabled="disabled">
                                                        <i class="pe-7s-less"></i>
                                                    </a>

                                                     <input style="width:50px; display:inline-block" v-model="cantidad" class="form-control" type="text"  value="1" min="1" max="10">

                                                    <a href="javascript:void(0)" @click="cantidad++" >
                                                        <i class="pe-7s-plus"></i>

                                                    </a>
                                                   </div>

                                            </div>
                                        </div>
                                        <div class="boton-pedido text-right">
                                            <button class="button text-uppercase" @click="modal=1,postPlato(Plato[index], modal, entrada, comentario, cantidad)"><span> Agregar a mi Orden </span><i class="pe-7s-shopbag"></i></button>
                                        </div>
                                    </div>
                                </div>
                               </div>








                        </div>


            </div>

        </div><!--End container -->
        </div><!--End bg_gray_container -->





</template>
<script>
import ScrollUp from 'vue-scroll-up';
import "vue-scroll-up/dist/style.css";
import EventBus from '../../event-bus'
export default {
    data() {
        return {
            Plato:{},
            entrada:'',
            comentario:'',
            errorPedido:0,
            errorMsjPedido:[],
            listado:0,
            cantidad:1,
            index: 0


        }
    },
    components:{
        ScrollUp
    },

    methods: {

        postPlato(plato, modal, entrada, comentario, cantidad){
            // if(this.validarPedido()){
            //     return
            // }
            Swal.fire({
                title: 'Estas seguro de agregar a tu orden?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28A745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText:'Cancelar'
            }).then((result) => {
            if (result.value) {

                EventBus.$emit('plato', plato);
                EventBus.$emit('entrada', entrada);
                EventBus.$emit('comentario', comentario);
                EventBus.$emit('modal', modal);
                EventBus.$emit('cantidad', cantidad);

                this.comentario= '';
                this.volverPlatos()
            }
            })
        },
        eventoModal(modal){
            EventBus.$emit('modal', modal);

        },
        // validarPedido(){
        //     this.errorPedido = 0;
        //     this.errorMsjPedido= [];

        //     if(this.entrada == '') this.errorMsjPedido.push('Seleccione sopa o entrada');


        //     if(this.errorMsjPedido.length) this.errorPedido = 1;
        //     return this.errorPedido


        // },
        volverPlatos(){
            setTimeout(() => {
                EventBus.$emit('listado',this.listado)
            }, 500);
        }
    },
    props:['platos','indice'],

    created(){
        this.Plato = this.platos;
        this.index = this.indice

    },


}
</script>
<style >
    .titulo-platos{
        color: rgb(149, 16, 38);
        font-size: 30px;
        padding: 10px;
        font-weight: 600;
    }
     .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
    .isDisabled {
        color: currentColor;
        cursor: not-allowed;
        opacity: 0.5;
        text-decoration: none;
        }
    .desayuno_box{
        height: 365px;
        overflow: hidden;
    }
    .desayuno_img{
       height: 480px;
        width: 100%;
        border-radius: 30px;
    }
    .almuerzo_img{
        height: 430px;
        width: 100%;
        border-radius: 30px;
    }
    .chifa_img{
        height: 482px;
    width: 100%;
    border-radius: 30px;
    }
</style>
