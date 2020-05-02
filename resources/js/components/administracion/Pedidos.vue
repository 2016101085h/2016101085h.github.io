<template>
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">



    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pedido</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Escritorio</a></li>
              <li class="breadcrumb-item active">Entrada</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                  <i class="fa fa-align-justify"></i> Pedidos

                </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <div class="form-group row">
                  <div class="col-md-6">
                    <div class="input-group">
                      <select class="form-control col-md-5" v-model="criterio">
                        <option value="nombre">Nombre de referencia</option>
                        <option value="fecha_hora">Fecha de pedido</option>

                      </select>
                      <input v-if="criterio == 'nombre'" type="text" v-model="buscar" @keyup.prevent="getPedido(1,buscar, criterio)" class="form-contPedido" placeholder="Texto a buscar">
                      <input type="date" v-if="criterio == 'fecha_hora'" class="form-control" v-model="buscar" @change.prevent="getPedido(1, buscar, criterio)">
                      <button v-if="criterio == 'nombre'" type="submit" class="btn btn-warning text-white rounded-0" @click="getRol(1, buscar, criterio)"><i class="fa fa-search"></i> Buscar</button>
                    </div>
                  </div>
                </div>
               <div class="table-hover">
                     <table class="table table-striped  ">
                  <tr class="bg-secondary">
                      <th>#</th>
                      <th>Nombre de referencia</th>
                    <th>Fecha hora</th>
                    <th>Celular</th>
                    <th >Direccion</th>
                    <th >Tipo pago</th>
                    <th>Estado</th>
                    <th >Opciones</th>
                  </tr>
                  <tr v-for="(pedido, index ) in arrayPedido" :key="pedido.id" >

                    <td>{{index+1}}</td>
                    <td> {{pedido.nombre}} </td>
                    <td> {{pedido.fecha_hora}} </td>
                    <td> {{pedido.celular}} </td>
                    <td> {{pedido.direccion}} </td>
                    <td> {{pedido.tipo_pago}} </td>
                    <td>
                        <span v-if="pedido.estado == '1'" class="badge bg-danger">Sin confirmar</span>
                        <span v-if="pedido.estado == '0'" class="badge bg-success">Confirmado</span>
                    </td>
                    <td>

                        <button type="button" class="btn btn-info  "  title="Ver detalles" @click="verPedido(pedido.id)">
                          <i class="fa fa-eye text-white"></i>
                        </button> &nbsp;
                        <button class="btn  btn-primary" type="button " @click="pdfPedido(pedido.id)" title="ver PDF" ><i class="fas fa-file-pdf"></i></button>
                        <button v-if="pedido.estado == '1'" type="button"  title="Atender" class="btn btn-warning text-white " @click="atenderPedido(pedido.id, buscar)">
                        <i class="fas fa-check-circle"></i>
                        </button>&nbsp;
                        <button  v-if="pedido.estado == '0'" type="button"  title="No atender" class="btn btn-secondary " @click="desatenderPedido(pedido.id, buscar)">
                          <i class="fa fa-edit text-white"></i>
                        </button>&nbsp;
                        <button   type="button" class="btn btn-danger "  title="Eliminar" @click="eliminarPedido(pedido.id, buscar)">
                          <i class="fa fa-trash text-white"></i>
                        </button>

                    </td>
                  </tr>




                </table>
               </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                 <li class="page-item" v-if="pagination.current_page > 1">
                            <a href="#" class="page-link" @click.prevent="cambiarpagina(pagination.current_page - 1, buscar, criterio)"> Prev</a>
                        </li>
                   <li class="page-item " v-for="page in pagesNumber" :key="page" :class = "[page == isActived ? 'active' :'' ]">
                            <a href="#" class="page-link" @click.prevent="cambiarpagina(page, buscar, criterio)">{{page}}</a>
                        </li>

                  <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                        <a href="#" class="page-link" @click.prevent="cambiarpagina(pagination.current_page + 1 , buscar, criterio)">Next </a>

                </li>
                </ul>
              </div>
            </div>
            <!-- /.card -->


          </div>
          <!-- /.col -->

        </div>
        <!-- /.row -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
      <!--Inicio del modal agregar/actualizar-->
   <div class="modal fade" id="modalNuevo" :class="{'mostrar':modal}" role="dialog" aria-labelledby="myModalLabel"
     style="display: none;" aria-hidden="true">
     <div class="modal-dialog modal-primary modal-lg" role="document">
       <div class="modal-contenido modal-content">
         <div class="modal-header bg-info">
           <h4 class="modal-title">Detalle del pedido</h4>
           <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
             <span aria-hidden="true">×</span>
           </button>
         </div>
         <div class="modal-body">
           <form action="" method="post"  class="form-horizontal">
             <div class="form-group row">
               <label class="col-md-3 form-control-label" for="text-input">Nombre de referencia</label>
               <div class="col-md-9">
                 <p  v-text="nombre" class="form-control" ></p>
                 <!-- <span class="help-block">(*) Ingrese el nombre de la categoría</span> -->
               </div>
             </div>
                 <div class="form-group row">
                    <div class="col-md-6">
                        <label class="col-xs-3 form-control-label" for="email-input">Fecha de pedido</label>
                    <div class="col-xs-9">
                        <p  v-text="fecha_hora"  class="form-control"></p>
                    </div>
                    </div>
                        <div class="col-md-6">
                            <label class="col-xs-3 form-control-label" for="email-input">Numero de celular</label>
                    <div class="col-xs-9">
                        <p v-text="celular" class="form-control" ></p>
                    </div>
                        </div>
             </div>
                 <div class="form-group row">
                    <div class="col-md-6">
                        <label class="col-xs-3 form-control-label" for="email-input">Direccion</label>
                    <div class="col-xs-9">
                        <p  v-text="direccion"  class="form-control"></p>
                    </div>
                    </div>
                        <div class="col-md-6">
                            <label class="col-xs-3 form-control-label" for="email-input">Tipo de pago</label>
                    <div class="col-xs-9">
                        <p v-text="tipo_pago" class="form-control" ></p>
                    </div>
                        </div>
             </div>

           </form>
           <div class="table-responsive">
                <table class="table table-bordered table-hover ">
                  <tr class="bg-secondary">
                      <th>#</th>
                    <th>Nombre del plato</th>
                    <th>Tipo</th>
                    <th>Entrada o sopa</th>
                    <th>Comentario</th>
                    <th >Cantidad</th>
                    <th >Precio</th>
                    <th class="text-uppercase text-bold">Subtotal</th>
                  </tr>
                  <tr v-for="(detalle, index ) in arrayDetalle" :key="detalle.id" >

                    <td>{{index+1}}</td>
                    <td> {{detalle.nombre_plato}} </td>
                    <td> {{detalle.tipo}} </td>
                    <td> {{detalle.entrada_sopa}} </td>
                    <td> {{detalle.comentario}}    </td>
                    <td>{{detalle.cantidad}}     </td>
                    <td>{{detalle.precio}}     </td>
                    <td class="bg-light text-center">{{(parseInt(detalle.precio) * detalle.cantidad).toFixed(2)}}</td>
                  </tr>
                  <tr class="bg-light">
                      <td colspan="7" class="text-bold text-center text-uppercase">Total</td>
                      <td class="text-bold text-center">S/ {{total}}</td>
                  </tr>



                </table>
           </div>

         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-warning" @click="cerrarModal()">Cerrar</button>

         </div>

       </div>
       <!-- /.modal-content -->

     </div>
     <!-- /.modal-dialog -->
   </div>
  </div>
  <!-- /.content-wrapper -->

</template>
<script>
export default {
    data() {
        return {

            arrayPedido:[],
            pagination: [],
            modal:0,
            comentario: '',
            total: 0,
            nombre:'',
            direccion:'',
            entrada_sopa:'',
            arrayDetalle:[],
            fecha_hora: '',
            tipoAccion: 0,
            celular:0
,
            criterio :'fecha_hora',
            buscar: '',

            pagination:{
                    'total':0,
                    'current_page':0,
                    'per_page':0,
                    'last_page':0,
                    'from':0,
                    'to':0,
            },
            offset:3,
            tipo_pago:''

        }
    },
    mounted() {
        this.getPedido(1, this.getFecha, this.criterio);
    },
     computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            pagesNumber: function(){
                if(!this.pagination.to){
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if(from<1){
                    from = 1;
                }
                var to = from + (this.offset*2);
                if(to>this.pagination.last_page){
                    to = this.pagination.last_page;
                }
                var pagesArray=[];
                while(from <= to){
                    pagesArray.push(from);
                    from++
                }
                return pagesArray;
            },
            getFecha(){
                let me = this;
                var hoy = new Date();
                var dd = hoy.getDate();
                var mm = hoy.getMonth()+1;
                var yyyy = hoy.getFullYear();

                dd = me.addZero(dd);
                mm = me.addZero(mm);

            return me.buscar = yyyy+'-'+mm+'-'+dd;
            },
        },
    methods: {
         addZero(i) {
            if (i < 10) {
                i = '0' + i;
            }
            return i;
        },
         pdfPedido(id){
                window.open("http://localhost:8000/pedido/pdf/"+ id );
            },
        getPedido(page, buscar, criterio){
            let me = this;
            var url = '/pedido?page='+page+'&buscar='+buscar+'&criterio='+criterio;
            axios.get(url).then((reponse)=>{
                console.log(reponse);
                var respuesta = reponse.data;
                me.arrayPedido = respuesta.pedido.data;
                me.pagination = respuesta.pagination;

            }).catch((error)=>{

            })
        },
        verPedido(id){
            let me = this;
            this.modal= 1
            var url = '/pedido/obtenercabecera?id='+id;
            var arrayPedido = [];
            axios.get(url).then((response)=>{
                var respuesta = response.data;
                console.log(respuesta)
                arrayPedido= respuesta.pedido;
                me.nombre = arrayPedido[0]['nombre']
                me.entrada_sopa = arrayPedido[0]['entrada_sopa'];
                me.comentario = arrayPedido[0]['comentario'];
                me.total = arrayPedido[0]['total'];
                me.direccion = arrayPedido[0]['direccion'];
                me.estado = arrayPedido[0]['estado'];
                me.fecha_hora = arrayPedido[0]['fecha_hora'];
                me.tipo_pago = arrayPedido[0]['tipo_pago'];
                me.celular = arrayPedido[0]['celular'];

            }).catch((error)=>{
                console.log(error);
            })

            var url = '/pedido/obtenerdetalles?id='+id;
            axios.get(url).then((response)=>{
                var respuesta = response.data;
                    me.arrayDetalle = respuesta.detalle;
            }).catch((error)=>{
                console.log(error);
            })
        },
         cambiarpagina(page, buscar, criterio){
                let me = this;
                me.pagination.current_page = page;
                me.getPedido(page, buscar, criterio);
            },



        atenderPedido(id, fecha){
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false,
            })
            swalWithBootstrapButtons.fire({
                title: 'Esta de confirmar este Pedido?',

                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result)=>{
            if(result.value){
                let me = this;
                axios.put('pedido/atender',{
                'id':id
                }).then((response)=>{
                me.cerrarModal();
                me.getPedido(1,fecha,'fecha_hora');
                swalWithBootstrapButtons.fire(
                'Confirmardo!',
                'El registro ha sido confirmado con exito.',
                'success'
                )
                }).catch((error)=>{
                console.log(error);
                });
            }else if(
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                    'Camcelado',
                    'Esta ascción ha sido cancelado :)',
                    'error'
                    )
                }
            })
        },
        desatenderPedido(id, fecha){
                 const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
                })
                swalWithBootstrapButtons.fire({
                    title: 'Esta de seguro de no confirmar este Pedido?',

                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then((result)=>{
                if(result.value){
                    let me = this;
                    axios.put('pedido/desatender',{
                    'id':id
                    }).then((response)=>{
                    me.cerrarModal();
                    me.getPedido(1,fecha,'fecha_hora');
                    swalWithBootstrapButtons.fire(
                    'Activado!',
                    'El registro no ha sido confirmado.',
                    'success'
                    )
                    }).catch((error)=>{
                    console.log(error);
                    });
                }else if(
                        // Read more about handling dismissals
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                        'Camcelado',
                        'Esta ascción ha sido cancelado :)',
                        'error'
                        )
                    }
                })
            },
              eliminarPedido(id, fecha){
                 const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
                })
                swalWithBootstrapButtons.fire({
                    title: 'Esta de seguro de no eliminar este Pedido?',

                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then((result)=>{
                if(result.value){
                    let me = this;
                    axios.put('pedido/eliminar',{
                    'id':id
                    }).then((response)=>{
                    me.cerrarModal();
                    me.getPedido(1,fecha,'fecha_hora');
                    swalWithBootstrapButtons.fire(
                    'Activado!',
                    'El registro no ha sido eliminado.',
                    'success'
                    )
                    }).catch((error)=>{
                    console.log(error);
                    });
                }else if(
                        // Read more about handling dismissals
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                        'Camcelado',
                        'Esta ascción ha sido cancelado :)',
                        'error'
                        )
                    }
                })
            },

        cerrarModal(){
          this.modal = 0;
          this.nombre= '';
          this.descripcion = ''

        },


    },
}
</script>
<style >
 .modal-contenido{
        width: 100%;
        position: absolute !important;
        top: 5rem;
        border-radius: 10px!important;
    }
   .mostrar{
        display: list-item !important;
        opacity: 1 !important;

        background-color: #16131391 !important;
        transition: all .5s ease-in-out !important;
    }
    .page-item.active .page-link{
        background-color: #6C757D!important;
    border-color: #6C757D!important;
    }
        /* .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    } */
</style>
