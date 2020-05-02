<template>
    <div>


           <div class="modal fade" id="modalNuevo" :class="{'mostrar':modal}" role="dialog" aria-labelledby="myModalLabel"
      aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-pedido modal-content" style="overflow:none!important">
                    <div class="modal-header titulo-pedido ">
                    <button type="button" class="close" @click="cerrarPedido()" aria-label="Close">
                        <span aria-hidden="true"><i class="far fa-window-close color-primario"></i></span>
                    </button>
                    <h4 class="modal-title color-primario text-uppercase text-center" style="font-weight:bold">Mi orden [{{arrayDetalle.length}}]</h4>
                    <button type="button" class="close" @click="limpiarPedido()" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-trash-alt color-primario"></i></span>
                    </button>
                    </div>
                    <div class="modal-body body-pedido">
                             <div  v-for="(pedido, index) in arrayDetalle" :key="pedido.id" class="strip_all_courses_list box-pedido animated fadeIn text-white" style="margin:0 auto 15px auto">
                                    <div class="row" >
                                        <div class="col-lg-5 col-md-5 col-sm-5">
                                            <div class="img_list img_lista">
                                                <a  href="javascript:void(0)" ><img :src="'img/platos/'+pedido.imagen" alt="">
                                                <div class="short_info">
                                                    <!-- <h3 class="text-uppercase" >nombre</h3> -->
                                                </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="clearfix visible-xs-block">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="course_list_desc  pedido_lista" style="color: #fff">
                                                <div>
                                                    <h3 style="color:#951026; font-weight:bold; font-size:15px"> {{pedido.nombre}}</h3>
                                                    <p style="margin:0 0 10px 0!important">S/. {{pedido.precio}}</p>
                                                    <p style="margin-bottom:10px!important" v-if="pedido.tipo == 'Desayuno'">
                                                     plato de fondo + {{pedido.entrada_sopa}}
                                                    </p>
                                                    <p  style="margin-bottom:10px!important" v-if="pedido.tipo == 'Almuerzo'">
                                                      {{pedido.entrada_sopa}} + Plato de fondo + refrezo
                                                    </p>
                                                    <p  style="margin-bottom:10px!important" v-if="pedido.tipo == 'Menu chifa'">
                                                     {{pedido.entrada_sopa}} + Plato de fondo + refrezco
                                                    </p>
                                                    <p style="font-weight:bold!important; text-transform:uppercase!important">{{pedido.tipo}}</p>
                                                </div>
                                                <div  class="cantidad-pedido ">
                                                    <div >

                                                        <div class="boton-cantidad boton-pedido">
                                                                <a  href="javascript:void(0)" @click="pedido.cantidad--" :class="{'isDisabled':pedido.cantidad == 1}" disabled="disabled">
                                                                <i class="pe-7s-less"></i>
                                                            </a>

                                                            <input style="width:50px; display:inline-block" v-model="pedido.cantidad" class="form-control" type="text"  value="1" min="1" max="10">

                                                            <a href="javascript:void(0)"  @click="pedido.cantidad++">
                                                                <i class="pe-7s-plus"></i>

                                                            </a>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-1">
                                            <div class="details_list_col detalle_lista">
                                                <div>
                                                    <a href="javascript:void(0)" @click="eliminarPedido(index)">x</a>

                                                    <!-- <a href="academic_single_course.html" class="btn btn-warning " @click="pasarDatos(plato)">  ORDENAR</a> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--End strip -->


                    </div>
                    <div class="modal-footer">
                        <div >
                            <div class="form-group row text-left">
                                    <label for="tel" class="col-sm-3" style="font-weight:bold">Nombre referencia</label>
                                <div class="col-sm-9">
                                    <input v-model="nombre" type="text" class="form-control input-pedido" id="tel" placeholder="Ingrese su nombre completo">
                                </div>
                            </div>
                            <div class="form-group row text-left">
                                 <label for="tipo_pago" class="col-sm-3" style="font-weight:bold">Celular</label>
                                <div class="col-sm-9">
                                     <input v-model="celular" type="tel" class="form-control input-pedido" id="tipo_pago" placeholder="Núumero telefónico">
                                </div>




                            </div>


                        <div class="form-group row text-left">
                            <label for="" class="col-sm-3" style="font-weight:bold">Tipo de pago</label>
                            <div class="col-sm-9">
                                <v-select style="border-radius:6px!important" v-model="tipo_pago " :options="['Efectivo','Tarjeta']" placeholder="Tipo de pago"></v-select>
                            </div>
                        </div>
                        <div class="form-group row text-left">
                                <label for="direccion" class="col-sm-3" style="font-weight:bold"> Tipo de envio</label>
                                    <div class="col-sm-9">
                                         <v-select style="border-radius:6px!important"  v-model="tipo_envio " :options="['Recoje en el restaurante','Envio a domicilio']" placeholder="Tipo de envio"></v-select>
                                    </div>
                        </div>
                        <template class="animated fadeIn" v-if="tipo_envio == 'Recoje en el restaurante'">
                            <div class="form-group row text-left">
                                <label for="direccion" class="col-sm-3" style="font-weight:bold">Direccion de Recojo</label>
                                    <div class="col-sm-9">
                                        <p v-text="getDireccion"  type="text" class="form-control input-pedido"  ></p>
                                    </div>
                            </div>
                        </template>
                        <template class="animated fadeIn" v-if="tipo_envio == 'Envio a domicilio'">
                            <div class="form-group row text-left">
                                <label for="direccion" class="col-sm-3" style="font-weight:bold">Dirección</label>
                                    <div class="col-sm-9">
                                        <input v-model="direccion" type="text" class="form-control input-pedido" id="direccion" placeholder="Ingrese la direccion de envio">
                                    </div>
                            </div>
                        </template>
                           <div v-show="errorBebida" class=" " style="margin:0; padding:0">

                        </div>
                        </div>
                        <div class="total-pedido">
                            <p class="color-primario text-uppercase" style="font-weight:bold">Total general</p>
                            <p style="font-weight:bold">S/. {{total=calcularTotal.toFixed(2)}}</p>
                        </div>
                        <div class="text-center">
                            <button  class=" boton-pedido-procesar  " style=" cursor: not-allowed;"  :class="{'button':this.nombre != '' && this.direccion != '' && this.celular != '' && this.tipo_pago != ''}" @click="guardarPedido()">
                                <i class="fas " style="margin-right:10px" :class="{'fa-sync-alt fa-spin':loading}"></i> Procesar Pedido</button>
                        </div>
                        <!-- :disabled="{'disabled': this.direccion == '' && this.celular == '' && this.tipo_pago == ''}" -->
                    </div>



                        </div>
                </div>
                <!-- /.modal-content -->

                </div>
                <!-- /.modal-dialog -->
   </div>

</template>
<script>
// import store from '../../store'
import EventBus from '../../event-bus';
 import vSelect from 'vue-select';
  import 'vue-select/dist/vue-select.css';
export default {
    components:{vSelect},
    data() {
        return {
            modal: 0,
            count: 0,
            arrayPedido: [],
            entrada:'',
            comentario:'',
            direccion:'',
            nombre:'',
            celular:'',
            arrayDetalle: [],
            cantidad:1,
            tipo_pago:'',
            total:0,
            loading:false,
             errorMostrarMsBebida:[],
            errorBebida:0,
            tipo_envio:''
        }
    },
    methods: {

        cerrarPedido(){
            this.modal = 0;
            if(this.arrayDetalle.length == 0){
                EventBus.$emit('modal', 0)
            }
        },
        cambiarValue(dato){
            if(dato === 'Recoje en el restaurante'){
                this.direccion = 'Av. evitamiento #581 - El tambo'
            }else
             if(dato === 'Envio a domicilio'){
                this.direccion = ''
            }
            return this.direccion
        },
       limpiarPedido(){
           let me = this;
           Swal.fire({
                title: 'Estas seguro de eliminar tu orden?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28A745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText:'Cancelar'
            }).then((result) => {
            if (result.value) {

               me.arrayPedido = [];
               me.arrayDetalle=[];
               me.nombre = '';
               me.direccion='';
               me.celular = '';
               me.tipo_pago='';
               me.tipo_envio = ''
               EventBus.$emit('cantidad_pedido', me.arrayPedido.length);
                EventBus.$emit('modal', 0)
            }
            })
       },
       eliminarPedido(index){
           let me = this;

           me.arrayPedido.splice(index,1);
           me.arrayDetalle.splice(index,1);

           EventBus.$emit('cantidad_pedido', me.arrayDetalle.length)
           if(me.arrayDetalle.length == 0){
               EventBus.$emit('modal', 0);
               me.nombre = '';
               me.celular = '';
               me.direccion = '';
               me.tipo_pago = '';
               me.tipo_envio = '';
           }
        //    this.entrada = '';
        //    this.comentario = ''
       },
       guardarPedido(){
           if(this.validarPedido()){
               return;
         }
         this.loading = true;



             setTimeout(() => {
                  let me = this;
              var url = '/pedido/registrar';
              axios.post(url,{
                  'celular': this.celular,
                  'tipo_pago': this.tipo_pago,
                  'direccion': this.direccion,
                  'total':this.total,
                  'nombre':this.nombre,
                  'data': this.arrayDetalle

              }).then((response)=>{
                //   console.log(response);
                    this.loading = false
                     Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: 'Tu pedido ha sido registrado con exito',
                    showConfirmButton: false,
                    timer: 3000
                    });
                    this.arrayDetalle=[];
                    this.celular = '';
                    this.direccion = '';
                    this.nombre = '';
                    this.tipo_pago = '';
                       EventBus.$emit('cantidad_pedido', me.arrayDetalle.length);


                        EventBus.$emit('modal', 0)
                       this.$router.push({name: 'inicio'})
              }).catch((error)=>{
                  console.log(error);
              })

             }, 1000);


       },
           encuetraPlato(entrada_sopa){
                var sw=0;
                for(var i=0;i<this.arrayDetalle.length;i++){
                    if(this.arrayDetalle[i].entrada_sopa == entrada_sopa){
                        sw=true;
                    }
                }
                return sw;
            },
               validarPedido(){
            this.errorPedido = 0;
            this.errorMostrarMsPedido= [];

            if(this.nombre == '') this.errorMostrarMsPedido.push('El nombre no puede estar vacio');
            if(this.imagen == '') this.errorMostrarMsPedido.push('La descripciom no puede estar vacio');

            if(this.errorMostrarMsPedido.length) this.errorPedido = 1;

            if(this.errorPedido == 1){

                this.errorMostrarMsPedido.forEach((error) =>{
                    console.log(error);
                // this.msgError(error);
                 this.msgError('Los campos son obligatorios')
                });
                return this.errorPedido ;


            }


        },
        msgError(error){

              Swal.fire({
                    position: 'center',
                    type: 'error',
                    title: error,
                    showConfirmButton: false,
                    timer: 3000
                    });
        },
    },

     created() {
         let me = this;
             EventBus.$on('modal', data=>{
                 me.modal = data
             })
             EventBus.$on('entrada', data=>{
                 me.entrada=data;
             })
             EventBus.$on('comentario', data=>{
                 me.comentario=data
             })
             EventBus.$on('cantidad',data=>{
                 me.cantidad = data
             })
             EventBus.$on('plato', data=>{

                //  if(me.encuetraPlato(this.entrada_sopa)){

                //      Swal.fire({
                //          position: 'center',
                //       type: 'error',
                //       title: 'El plato ya se encuentra gregado ',
                //       showConfirmButton: true,
                //       timer: 3500
                //     })
                //      me.cerrarPedido()
                //  }else{

                    me.arrayPedido.push(data);
                 setTimeout(() => {
                     me.arrayDetalle.push({
                         plato_id: data.id,
                         entrada_sopa: me.entrada,
                         comentario: me.comentario,
                         precio: data.precio,
                         cantidad: me.cantidad,
                         imagen: data.imagen,
                         nombre: data.nombre,
                         tipo: data.tipo

                     })
                 }, 500);
                 EventBus.$emit('cantidad_pedido', me.arrayPedido.length)}
             )
         },
         computed: {
              calcularTotal:function(){
                var resultado = 0.0;
                for(var i=0;i<this.arrayDetalle.length;i++){
                    resultado = resultado+(this.arrayDetalle[i].precio*this.arrayDetalle[i].cantidad)
                }
                return resultado;
            },
            getDireccion: function(){
                if(this.tipo_envio == 'Recoje en el restaurante'){

                    this.direccion = 'Av. evitamiento #581 - El tambo - Huancayo'
                }else{
                    this.direccion = ''
                }
                return this.direccion;
            }
         },






}
</script>

<style >
    .vs__dropdown-toggle {
    border-radius: 6px;
    height: 34px;
}
.form-control.is-invalid{
    border-color: #dc3545;
}
.form-control.is-invalid:focus{
        border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220,53,69,.25);
}
</style>
