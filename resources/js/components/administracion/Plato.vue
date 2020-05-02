<template>
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">



    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Platos de comida</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Escritorio</a></li>
              <li class="breadcrumb-item active">Platos de comida</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                  <i class="fa fa-align-justify"></i> Roles
                  <button type="button" class="btn btn-secondary bg-info ml-2 border-transparent " @click="abrirModal('plato','guardar')  ">
                    <i class="fa fa-plus"></i>&nbsp;Nuevo
                  </button>
                </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <div class="row mb-1">

                  <div class="col-md-7 mb-3">
                        <div class="d-flex">
                            <select  style="flex:1" class="form-control " v-model="criterio">
                                <option value="nombre">Nombre</option>
                                <option value="tipo_plato_id">Tipo</option>

                            </select>
                            <input style="flex:1"  v-if="criterio == 'nombre'" type="text" v-model="buscar" @keyup.prevent="getPlato(1,buscar,criterio, tipo_plato, fechaInit)" class="form-control" placeholder="Texto a buscar">
                            <select style="flex:1"  v-if="criterio == 'tipo_plato_id'"  v-model="tipo_plato" @change="getPlato(1,buscar,criterio, tipo_plato, fechaInit)" class="form-control" >
                                <option value="1">Desayuno</option>
                                <option value="2">Almuerzo</option>
                                <option value="3">Menu Chifa</option>
                            </select>
                            <button v-if="criterio == 'nombre'" style="flex:1" type="submit" class="btn btn-warning text-white rounded-0" @click="getPlato(1,buscar,criterio, tipo_plato, fechaInit)"><i class="fa fa-search"></i> Buscar</button>
                    </div>
                  </div>
                  <div class="col-md-1"></div>

                    <div class="col-md-4 mb-3">
                          <div class="d-flex align-items-center">
                      <label for="fechaInit" class="mr-5">Fecha</label>
                      <input type="date" @change="getPlato(1, buscar, criterio, tipo_plato, fechaInit)" id="fechaInit" v-model="fechaInit" class="form-control">
                  </div>
                    </div>
                </div>
                <table class="table table-striped table-hover ">
                  <tr class="bg-secondary">
                      <th>#</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Tipo</th>
                    <!-- <th>Fehca</th> -->
                    <th >Imagen</th>
                    <th >Opciones</th>
                  </tr>
                  <tr v-for="(plato, index ) in arrayPlato" :key="plato.id" >

                    <td>{{index+1}}</td>
                    <td> {{plato.nombre}} </td>
                    <td> {{plato.precio}} </td>
                    <td> {{plato.tipo}} </td>
                    <!-- <td>{{plato.fecha}}</td> -->
                    <td>  <img :src="'img/platos/' + plato.imagen" class="img-fluid" width="50px" height="50px"> </td>

                    <td>
                        <button type="button" class="btn btn-warning btn-sm" @click="abrirModal('plato','actualizar',plato)">
                          <i class="fa fa-pen"></i>
                        </button> &nbsp;
                        <button  type="button" class="btn btn-danger btn-sm text-white" @click="eliminarPlato(plato.id, fechaInit, plato.tipo_plato_id)">
                          <i class="fa fa-trash"></i>
                        </button>

                    </td>
                  </tr>



                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                 <li class="page-item" v-if="pagination.current_page > 1">
                            <a href="#" class="page-link" @click.prevent="cambiarpagina(pagination.current_page - 1, buscar, criterio, tipo_plato, fechaInit)"> Prev</a>
                        </li>
                   <li class="page-item " v-for="page in pagesNumber" :key="page" :class = "[page == isActived ? 'active' :'' ]">
                            <a href="#" class="page-link" @click.prevent="cambiarpagina(page, buscar, criterio, tipo_plato, fechaInit)">{{page}}</a>
                        </li>

                  <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                        <a href="#" class="page-link" @click.prevent="cambiarpagina(pagination.current_page + 1 , buscar, criterio, tipo_plato, fechaInit)">Next </a>

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
           <h4 class="modal-title">{{tituloModal}}</h4>
           <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
             <span aria-hidden="true">×</span>
           </button>
         </div>
         <div class="modal-body">
           <form action="" method="post"  class="form-horizontal">
            <div class="form-group row">
                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                    <div class="col-md-9">
                        <input type="text" v-model="nombre" class="form-control" placeholder="Nombre de plato de Comoda">
                        <!-- <span class="help-block">(*) Ingrese el nombre de la categoría</span> -->
                    </div>
             </div>
               <div class="form-group row">

                        <div class="col-md-6">
                            <label class="col-xs-3 form-control-label" for="email-input">Tipo de comida</label>
                            <div class="col-xs-9">
                                <select   v-model="tipo_plato_id" class="form-control" >
                                    <option value="0" selected disabled>Ingrese el tipo de Comida</option>
                                  <option v-for="tipo in arrayTipo" :key="tipo.id" :value="tipo.id" >{{tipo.nombre}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-xs-3 form-control-label" for="email-input">Bebida</label>
                            <div class="col-xs-9">
                                <select   v-model="bebida_id" class="form-control" >
                                    <option value="1" selected disabled>Ingrese la bebida</option>
                                   <option v-for="bebida in arrayBebida" :key="bebida.id" :value="bebida.id" >{{bebida.nombre}}</option>
                                </select>
                            </div>
                        </div>
                </div>
               <div class="form-group row">
                        <div class="col-md-6">
                            <label class="col-xs-3 form-control-label" for="email-input">Sopa </label>
                            <div class="col-xs-9">
                                <select   v-model="sopa_id" class="form-control" >
                                    <option value="2" selected disabled>Ingrese la sopa</option>
                                    <option v-for="sopa in arraySopa" :key="sopa.id" :value="sopa.id" >{{sopa.nombre}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-xs-3 form-control-label" for="email-input">Entrada</label>
                            <div class="col-xs-9">
                                <select   v-model="entrada_id" class="form-control" >
                                    <option value="3" selected disabled>Ingrese la entrada</option>
                                    <option v-for="entrada in arrayEntrada" :key="entrada.id" :value="entrada.id" >{{entrada.nombre}}</option>
                                </select>
                            </div>
                        </div>
                </div>
            <div class="form-group row">
               <div class="col-md-6">
                    <label class="col-xs-3 form-control-label" for="email-input">Precio del plato </label>
                    <div class="col-xs-9">
                        <input type="number" v-model="precio" class="form-control" placeholder="Ingrese el precio del plato">
                    </div>
               </div>
                  <div class="col-md-6">
                       <label class="col-xs-3 form-control-label" for="email-input">Fecha disponible</label>
                        <div class="col-xs-9">
                            <input type="date"  v-model="fecha" class="form-control" placeholder="Ingrese la fecha ">
                        </div>
                  </div>
             </div>



              <template v-if="tipoAccion==0">
                    <div class="form-group row">

                        <!--poniendo :src se llama a la variable imagen que esta declarada en la propiedad data-->
                            <!--poner this.imagen=""; en cerrarModal para limpiar el campo ya que aparecia la imagen al registrar un registro-->
                        <label class="col-md-3 form-control-label"> Imagen de Bebida</label>
                             <div class="col-md-9">
                                <div class="custom-file">
                                    <input type="file"  @change="subirImagen" class="custom-file-input"  aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">Seleccione archivo</label>

                                </div>
                            </div>
                            <div class="col-md-3"></div>
                            <img :src="imagen" class="img-fluid col-md-3" width="10px" >

                    </div>
                </template>
                <template v-if="tipoAccion==1">
                    <div class="form-group row">

                        <!--poniendo :src se llama a la variable imagen que esta declarada en la propiedad data-->
                            <!--poner this.imagen=""; en cerrarModal para limpiar el campo ya que aparecia la imagen al registrar un registro-->
                      <label class="col-md-3 form-control-label"> Imagen de Bebida</label>
                             <div class="col-md-9">
                                <div class="custom-file">
                                    <input type="file"  @change="subirImagen" class="custom-file-input"  aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">Seleccione archivo</label>

                                </div>
                            </div>
                            <div class="col-md-3"></div>
                            <img :src="imagen" class="img-fluid col-md-3" width="10px" >

                    </div>
                </template>
           </form>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-danger" @click="cerrarModal()">Cerrar</button>
           <button v-if="tipoAccion == 0" type="button" class="btn btn-warning" @click="guardarPlato(fechaInit, tipo_plato_id)">Guardar</button>
           <button v-if="tipoAccion == 1" type="button" class="btn btn-success" @click="actualizarPlato(fechaInit, tipo_plato_id)">Actualizar</button>
         </div>
           <div v-show="errorPlato" class="form-group row div-error m-0">

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
            hola: 'menu',
            arrayPlato:[],
            pagination: [],
            modal:0,
            tituloModal: '',
            nombre: '',
            imagen: '',
            tipo: '',
            tipo_plato_id:0,
            sopa_id:0,
            bebida_id:0,
            entrada_id:0,
            precio:0.00,
            fecha:'',
            tipoAccion: 0,
            plato_id:0,
            criterio :'tipo_plato_id',
            buscar: '',
            errorMostrarMsPlato:[],
            errorPlato:0,
            pagination:{
                'total':0,
                'current_page':0,
                'per_page':0,
                'last_page':0,
                'from':0,
                'to':0,
            },
            fechaInit:'',
            tipo_plato:1,
            offset:3,
            arrayTipo:[],
            arraySopa: [],
            arrayEntrada: [],
            arrayBebida:[],


        }
    },
    mounted() {
        this.getPlato(1, this.buscar, this.criterio, this.tipo_plato, this.getFecha);
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

            return me.fechaInit = yyyy+'-'+mm+'-'+dd;
            },
        },
    methods: {
         addZero(i) {
            if (i < 10) {
                i = '0' + i;
            }
            return i;
        },
        getPlato(page, buscar, criterio, tipo, fecha){
            let me = this;
            var url = '/plato?page='+page+'&buscar='+buscar+'&criterio='+criterio+'&tipo='+tipo+'&fecha='+fecha;
            axios.get(url).then((reponse)=>{
                console.log(reponse);
                var respuesta = reponse.data;
                me.arrayPlato = respuesta.plato.data;
                me.pagination = respuesta.pagination;

            }).catch((error)=>{

            })
        },
        selectTipo(){
            let me =this;
            axios.get('/tipo-plato/selectipo-plato').then((response)=>{
                console.log(response);
                var respuesta = response.data;
                me.arrayTipo = respuesta.tipo
            }).catch((error)=>{
                console.log(error);
            })
        },
        selectBebida(){
            let me =this;
            axios.get('/bebida/selectbebida').then((response)=>{
                console.log(response);
                var respuesta = response.data;
                me.arrayBebida = respuesta.bebida
            }).catch((error)=>{
                console.log(error);
            })
        },
        selectSopa(){
            let me =this;
            axios.get('/sopa/selectsopa').then((response)=>{
                console.log(response);
                var respuesta = response.data;
                me.arraySopa = respuesta.sopa
            }).catch((error)=>{
                console.log(error);
            })
        },
        selectEntrada(){
            let me =this;
            axios.get('/entrada/selectentrada').then((response)=>{
                console.log(response);
                var respuesta = response.data;
                me.arrayEntrada = respuesta.entrada
            }).catch((error)=>{
                console.log(error);
            })
        },

        subirImagen(e){
            let me=this;
            let file=e.target.files[0];

            let reader= new FileReader();
            reader.onloadend=(file)=>{
                me.imagen=reader.result;
            }
            reader.readAsDataURL(file);
        },
         cambiarpagina(page, buscar, criterio, tipo, fecha){
                let me = this;
                me.pagination.current_page = page;
                me.getPlato(page, buscar, criterio, tipo, fecha);
            },
         msgExitoso(accion){
                Swal.fire({
                    position: 'top-end',
                    type: 'success',
                    title: 'Registro ' +accion+ ' exitosamente',
                    showConfirmButton: false,
                    background:'#EBFEB6',
                    toast:true,
                    timer: 2000
                    });
            },
        guardarPlato(fecha, tipo_plato){
            if (this.validarPlato()){
                    return;
                }
          let me = this;
          var url = '/plato/agregar';
          axios.post(url,{
            'nombre': this.nombre,
            'tipo_plato_id': this.tipo_plato_id,
            'sopa_id': this.sopa_id,
            'entrada_id': this.entrada_id,
            'bebida_id': this.bebida_id,
            'precio': this.precio,
            'fecha': this.fecha,
            'imagen': this.imagen
          }).then((response)=>{
            console.log(response);
            this.msgExitoso('guardado');
            this.cerrarModal();
            this.getPlato(1,'','tipo_plato_id',tipo_plato,fecha);
               this.tipo_plato = tipo_plato;
          }).catch((error)=>{
            console.log(error);
          })

        },
        actualizarPlato(fecha, tipo_plato){
              if (this.validarPlato()){
                    return;
                }
            let me = this;
            var url = '/plato/actualizar';
            axios.put(url, {
                'id' : this.plato_id,
                'nombre': this.nombre,
                'tipo_plato_id': this.tipo_plato_id,
                'sopa_id': this.sopa_id,
                'entrada_id': this.entrada_id,
                'bebida_id': this.bebida_id,
                'precio': this.precio,
                'fecha': this.fecha,
                'imagen': this.imagen
            }).then((reposne)=>{
                console.log(reposne);
                this.msgExitoso('actualizado');
                this.cerrarModal();
                this.getPlato(1,'','tipo_plato_id',tipo_plato,fecha);
                   this.tipo_plato = tipo_plato;
            }).catch((error)=>{
                console.log(error);
            })

        },
        eliminarPlato(id, fecha, tipo_plato){
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false,
            })
            swalWithBootstrapButtons.fire({
                title: 'Esta de seguro de eliminar esta Plato?',

                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result)=>{
            if(result.value){
                let me = this;
                axios.put('plato/eliminar',{
                'id':id
                }).then((response)=>{
                me.cerrarModal();
                this.getPlato(1,'','tipo_plato_id',tipo_plato,fecha);
                this.tipo_plato = tipo_plato;
                swalWithBootstrapButtons.fire(
                'Eliminado!',
                'El registro ha sido eliminado con exito.',
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
                    'Esta acción ha sido cancelado :)',
                    'error'
                    )
                }
            })
        },

        abrirModal(modelo, accion, data = []){
          switch(modelo){
            case 'plato':
            {
              switch(accion){
                case 'guardar' :
                {
                  this.modal=1;
                  this.tituloModal = 'Agregar nuevo Plato de comida'
                  this.nombre = '';
                  this.tipo_plato_id = '0';
                  this.bebida_id = '1';
                  this.sopa_id = '2';
                  this.entrada_id = '3';
                  this.precio = '';
                  this.fecha = this.getFecha;
                  this.imagen = '';
                  this.tipoAccion = 0


                  break;
                }
                case 'actualizar':
                {
                  this.modal = 1;
                  this.tipoAccion = 1;
                  this.tituloModal = 'Actualizar Plato de comida';
                  this.plato_id = data['id'];
                  this.nombre = data['nombre'];
                  this.bebida_id = data['bebida_id'];
                  this.sopa_id = data['sopa_id'];
                  this.entrada_id = data['entrada_id'];
                  this.precio = data['precio'];
                  this.fecha = data['fecha'];
                  this.tipo_plato_id = data['tipo_plato_id'];
                  this.imagen = data['imagen']

                  break;
                }
              }
            }
            this.selectTipo();
            this.selectBebida();
            this.selectSopa();
            this.selectEntrada()
          }

        },
        cerrarModal(){
          this.modal = 0;
            this.nombre = '';
            this.tipo_plato_id = '0';
            this.bebida_id = '1';
            this.sopa_id = '2';
            this.entrada_id = '3';
            this.precio = '';
            this.fecha = '';
            this.imagen = '';

        },
        validarPlato(){
            this.errorPlato = 0;
            this.errorMostrarMsPlato= [];

            if(this.nombre == '') this.errorMostrarMsPlato.push('El nombre no puede estar vacio');
            if(this.imagen == '') this.errorMostrarMsPlato.push('La descripciom no puede estar vacio');

            if(this.errorMostrarMsPlato.length) this.errorPlato = 1;

            if(this.errorPlato == 1){

                this.errorMostrarMsPlato.forEach((error) =>{
                    console.log(error);
                // this.msgError(error);
                 this.msgError('Los campos son obligatorios')
                });
                return this.errorPlato ;


            }


        },
        msgError(error){

            Swal.fire({
                position: 'top-end',
                type: 'error',
                title: error,
                showConfirmButton: false,
                background:'#FADBD8',
                toast:true,

                timer: 2000
            });
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
    .modal-body{
        overflow: auto!important;
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
