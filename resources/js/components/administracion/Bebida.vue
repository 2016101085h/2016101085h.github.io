<template>
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">



    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Bebidas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Escritorio</a></li>
              <li class="breadcrumb-item active">Bebidas</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                  <i class="fa fa-align-justify"></i> Roles
                  <button type="button" class="btn btn-secondary bg-info ml-2 border-transparent " @click="abrirModal('bebida','guardar')  ">
                    <i class="fa fa-plus"></i>&nbsp;Nuevo
                  </button>
                </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <div class="form-group row">
                  <div class="col-md-6">
                    <div class="input-group">
                      <select class="form-control col-md-3" v-model="criterio">
                        <option value="nombre">Nombre</option>

                      </select>
                      <input type="text" v-model="buscar" @keyup.prevent="getBebida(1,buscar, criterio)" class="form-control" placeholder="Texto a buscar">
                      <button type="submit" class="btn btn-warning text-white rounded-0" @click="getBebida(1, buscar, criterio)"><i class="fa fa-search"></i> Buscar</button>
                    </div>
                  </div>
                </div>
                <table class="table table-striped table-hover ">
                  <tr class="bg-secondary">
                      <th>#</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th >Imagen</th>
                    <th >Opciones</th>
                  </tr>
                  <tr v-for="(bebida, index ) in arrayBebida" :key="bebida.id" >

                    <td>{{index+1}}</td>
                    <td> {{bebida.nombre}} </td>
                    <td> {{bebida.tipo}} </td>
                    <td> {{bebida.fecha}} </td>
                    <td>  <img :src="'img/bebidas/' + bebida.imagen" class="img-fluid" width="100px" height="100px"> </td>

                    <td>
                        <button type="button" class="btn btn-warning btn-sm" @click="abrirModal('bebida','actualizar',bebida)">
                          <i class="fa fa-pen"></i>
                        </button> &nbsp;
                        <button  type="button" class="btn btn-danger btn-sm text-white" @click="eliminarBebida(bebida.id)">
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
                 <input type="text" v-model="nombre" class="form-control" placeholder="Nombre de la bebida">
                 <!-- <span class="help-block">(*) Ingrese el nombre de la categoría</span> -->
               </div>
             </div>
             <div class="form-group row">
               <label class="col-md-3 form-control-label" for="text-input">Fecha</label>
               <div class="col-md-9">
                 <input type="date" v-model="fecha" class="form-control" placeholder="Fecha disponible">
                 <!-- <span class="help-block">(*) Ingrese el nombre de la categoría</span> -->
               </div>
             </div>
             <div class="form-group row">
               <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
               <div class="col-md-9">
                 <select  v-model="tipo" class="form-control" >
                     <option value="1" selected disabled>Elija un tipo de bebida</option>
                     <option value="caliente">Caliente</option>
                     <option value="frio">Frio</option>
                 </select>
                 <!-- <span class="help-block">(*) Ingrese el nombre de la categoría</span> -->
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
           <button v-if="tipoAccion == 0" type="button" class="btn btn-warning" @click="guardarBebida()">Guardar</button>
           <button v-if="tipoAccion == 1" type="button" class="btn btn-success" @click="actualizarBebida()">Actualizar</button>
         </div>
           <div v-show="errorBebida" class="form-group row div-error m-0">

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
            arrayBebida:[],
            pagination: [],
            modal:0,
            tituloModal: '',
            nombre: '',
            imagen: '',
            tipo: '',
            fecha:'',
            tipoAccion: 0,
            bebida_id:0,
            criterio :'nombre',
            buscar: '',
            errorMostrarMsBebida:[],
            errorBebida:0,
            pagination:{
                'total':0,
                'current_page':0,
                'per_page':0,
                'last_page':0,
                'from':0,
                'to':0,
            },
            offset:3

        }
    },
    mounted() {
        this.getBebida(1, this.buscar, this.criterio);
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

            return me.fecha = yyyy+'-'+mm+'-'+dd;
            },
        },
    methods: {
         addZero(i) {
            if (i < 10) {
                i = '0' + i;
            }
            return i;
        },
        getBebida(page, buscar, criterio){
            let me = this;
            var url = '/bebida?page='+page+'&buscar='+buscar+'&criterio='+criterio;
            axios.get(url).then((reponse)=>{
                console.log(reponse);
                var respuesta = reponse.data;
                me.arrayBebida = respuesta.bebida.data;
                me.pagination = respuesta.pagination;

            }).catch((error)=>{

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
         cambiarpagina(page, buscar, criterio){
                let me = this;
                me.pagination.current_page = page;
                me.getBebida(page, buscar, criterio);
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
        guardarBebida(){
            if (this.validarBebida()){
                    return;
                }
          let me = this;
          var url = '/bebida/agregar';
          axios.post(url,{
            'nombre': this.nombre,
            'tipo': this.tipo,
            'imagen': this.imagen,
            'fecha':this.fecha
          }).then((response)=>{
            console.log(response);
            this.msgExitoso('guardado');
            this.cerrarModal();
            this.getBebida(1,'','nombre');
          }).catch((error)=>{
            console.log(error);
          })

        },
        actualizarBebida(){
              if (this.validarBebida()){
                    return;
                }
            let me = this;
            var url = '/bebida/actualizar';
            axios.put(url, {
                'id' : this.bebida_id,
                'nombre':this.nombre,
                'tipo':this.tipo,
                'imagen':this.imagen,
                'fecha':this.fecha
            }).then((reposne)=>{
                console.log(reposne);
                this.msgExitoso('actualizado');
                this.cerrarModal();
                this.getBebida(1,'','nombre');
            }).catch((error)=>{
                console.log(error);
            })

        },
        eliminarBebida(id){
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false,
            })
            swalWithBootstrapButtons.fire({
                title: 'Esta de seguro de eliminar esta Bebida?',

                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result)=>{
            if(result.value){
                let me = this;
                axios.put('bebida/eliminar',{
                'id':id
                }).then((response)=>{
                me.cerrarModal();
                me.getBebida(1,'','nombre');
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
            case 'bebida':
            {
              switch(accion){
                case 'guardar' :
                {
                  this.modal=1;
                  this.tituloModal = 'Agregar nueva Bebida'
                  this.nombre = '';
                  this.imagen = '';
                  this.fecha=this.getFecha;
                  this.tipo = '1';
                  this.tipoAccion = 0


                  break;
                }
                case 'actualizar':
                {
                  this.modal = 1;
                  this.tipoAccion = 1;
                  this.tituloModal = 'Actualizar Bebida';
                  this.bebida_id = data['id'];
                  this.nombre = data['nombre'];
                  this.fecha = data['fecha'];
                  this.tipo = data['tipo'];
                  this.imagen = data['imagen']

                  break;
                }
              }
            }
          }

        },
        cerrarModal(){
          this.modal = 0;
          this.nombre= '';
          this.imagen = '';
          this.tipo = '';
          this.fecha='';

        },
        validarBebida(){
            this.errorBebida = 0;
            this.errorMostrarMsBebida= [];

            if(this.nombre == '') this.errorMostrarMsBebida.push('El nombre no puede estar vacio');
            if(this.imagen == '') this.errorMostrarMsBebida.push('La descripciom no puede estar vacio');

            if(this.errorMostrarMsBebida.length) this.errorBebida = 1;

            if(this.errorBebida == 1){

                this.errorMostrarMsBebida.forEach((error) =>{
                    console.log(error);
                // this.msgError(error);
                 this.msgError('Los campos son obligatorios')
                });
                return this.errorBebida ;


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
        /* .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    } */
</style>
