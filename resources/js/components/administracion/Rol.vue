<template>
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">



    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Rol</h1>
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
                  <i class="fa fa-align-justify"></i> Entradas
                  <button type="button" class="btn btn-secondary bg-info ml-2 border-transparent " @click="abrirModal('rol','guardar')  ">
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
                      <input type="text" v-model="buscar" @keyup.prevent="getRol(1,buscar, criterio)" class="form-control" placeholder="Texto a buscar">
                      <button type="submit" class="btn btn-warning text-white rounded-0" @click="getRol(1, buscar, criterio)"><i class="fa fa-search"></i> Buscar</button>
                    </div>
                  </div>
                </div>
                <table class="table table-striped table-hover ">
                  <tr class="bg-secondary">
                      <th>#</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th >Estado</th>
                    <th >Opciones</th>
                  </tr>
                  <tr v-for="(rol, index ) in arrayRol" :key="rol.id" >

                    <td>{{index+1}}</td>
                    <td> {{rol.nombre}} </td>
                    <td> {{rol.descripciom}} </td>
                    <td>
                        <span v-if="rol.condicion == '1'" class="badge bg-success">Activo</span>
                        <span v-if="rol.condicion == '0'" class="badge bg-danger">Inactivo</span>
                    </td>
                    <td>
                        <button type="button" class="btn btn-warning btn-sm" @click="abrirModal('rol','actualizar',rol)">
                          <i class="fa fa-pen"></i>
                        </button> &nbsp;
                        <button v-if="rol.condicion == '1'" type="button" class="btn btn-danger btn-sm text-white" @click="desactivarRol(rol.id)">
                          <i class="fa fa-trash"></i>
                        </button>
                        <button  v-if="rol.condicion == '0'" type="button" class="btn btn-primary btn-sm" @click="activarRol(rol.id)">
                          <i class="fa fa-check"></i>
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
                 <input type="text" v-model="nombre" class="form-control" placeholder="Nombre de Rol">
                 <!-- <span class="help-block">(*) Ingrese el nombre de la categoría</span> -->
               </div>
             </div>
             <div class="form-group row">
               <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
               <div class="col-md-9">
                 <input type="email" v-model="descripcion" class="form-control" placeholder="Ingrese la descripcion">
               </div>
             </div>
           </form>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-danger" @click="cerrarModal()">Cerrar</button>
           <button v-if="tipoAccion == 0" type="button" class="btn btn-warning" @click="guardarRol()">Guardar</button>
           <button v-if="tipoAccion == 1" type="button" class="btn btn-success" @click="actualizarRol()">Actualizar</button>
         </div>
           <div v-show="errorRol" class="form-group row div-error m-0">

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
            arrayRol:[],
            pagination: [],
            modal:0,
            tituloModal: '',
            nombre: '',
            descripcion: '',
            tipoAccion: 0,
            rol_id:0,
            criterio :'nombre',
            buscar: '',
            errorMostrarMsRol:[],
            errorRol:0,
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
        this.getRol(1, this.buscar, this.criterio);
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
            }
        },
    methods: {
        getRol(page, buscar, criterio){
            let me = this;
            var url = '/rol?page='+page+'&buscar='+buscar+'&criterio='+criterio;
            axios.get(url).then((reponse)=>{
                console.log(reponse);
                var respuesta = reponse.data;
                me.arrayRol = respuesta.rol.data;
                me.pagination = respuesta.pagination;

            }).catch((error)=>{

            })
        },
         cambiarpagina(page, buscar, criterio){
                let me = this;
                me.pagination.current_page = page;
                me.getRol(page, buscar, criterio);
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
        guardarRol(){
            if (this.validarRol()){
                    return;
                }
          let me = this;
          var url = '/rol/agregar';
          axios.post(url,{
            'nombre': this.nombre,
            'descripciom': this.descripcion
          }).then((response)=>{
            console.log(response);
            this.msgExitoso('guardado');
            this.cerrarModal();
            this.getRol(1,'','nombre');
          }).catch((error)=>{
            console.log(error);
          })

        },
        actualizarRol(){
              if (this.validarRol()){
                    return;
                }
            let me = this;
            var url = '/rol/actualizar';
            axios.put(url, {
                'id' : this.rol_id,
                'nombre':this.nombre,
                'descripciom':this.descripcion
            }).then((reposne)=>{
                console.log(reposne);
                this.msgExitoso('actualizado');
                this.cerrarModal();
                this.getRol(1,'','nombre');
            }).catch((error)=>{
                console.log(error);
            })

        },
        desactivarRol(id){
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false,
            })
            swalWithBootstrapButtons.fire({
                title: 'Esta de seguro de desactivar este Rol?',

                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result)=>{
            if(result.value){
                let me = this;
                axios.put('rol/desactivar',{
                'id':id
                }).then((response)=>{
                me.cerrarModal();
                me.getRol(1,'','nombre');
                swalWithBootstrapButtons.fire(
                'Desactivado!',
                'El registro ha sido desactivado con exito.',
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
        activarRol(id){
                 const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
                })
                swalWithBootstrapButtons.fire({
                    title: 'Esta de seguro de activar este Rol?',

                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then((result)=>{
                if(result.value){
                    let me = this;
                    axios.put('rol/activar',{
                    'id':id
                    }).then((response)=>{
                    me.cerrarModal();
                    me.getRol(1,'','nombre');
                    swalWithBootstrapButtons.fire(
                    'Activado!',
                    'El registro ha sido activado con exito.',
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
        abrirModal(modelo, accion, data = []){
          switch(modelo){
            case 'rol':
            {
              switch(accion){
                case 'guardar' :
                {
                  this.modal=1;
                  this.tituloModal = 'Agregar nuevo Rol'
                  this.nombre = '';
                  this.tipoAccion = 0
                  this.descripcion = '';

                  break;
                }
                case 'actualizar':
                {
                  this.modal = 1;
                  this.tipoAccion = 1;
                  this.tituloModal = 'Actualizar Rol';
                  this.rol_id = data['id'];
                  this.nombre = data['nombre'];
                  this.descripcion = data['descripciom'];
                  break;
                }
              }
            }
          }
          this.modal = 1;
        },
        cerrarModal(){
          this.modal = 0;
          this.nombre= '';
          this.descripcion = ''

        },
        validarRol(){
            this.errorRol = 0;
            this.errorMostrarMsRol= [];

            if(this.nombre == '') this.errorMostrarMsRol.push('El nombre no puede estar vacio');
            if(this.descripcion == '') this.errorMostrarMsRol.push('La descripciom no puede estar vacio');

            if(this.errorMostrarMsRol.length) this.errorRol = 1;

            if(this.errorRol == 1){

                this.errorMostrarMsRol.forEach((error) =>{
                    console.log(error);
                // this.msgError(error);
                 this.msgError('Los campos son obligatorios')
                });
                return this.errorRol ;
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
