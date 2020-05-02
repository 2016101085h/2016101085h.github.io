<template>
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">



    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Usuarios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Escritorio</a></li>
              <li class="breadcrumb-item active">Usuarios</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                  <i class="fa fa-align-justify"></i> Roles
                  <button type="button" class="btn btn-secondary bg-info ml-2 border-transparent " @click="abrirModal('usuario','guardar')  ">
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
                      <input type="text" v-model="buscar" @keyup.prevent="getUsuario(1,buscar, criterio)" class="form-control" placeholder="Texto a buscar">
                      <button type="submit" class="btn btn-warning text-white rounded-0" @click="getUsuario(1, buscar, criterio)"><i class="fa fa-search"></i> Buscar</button>
                    </div>
                  </div>
                </div>
                <table class="table table-striped table-hover ">
                  <tr class="bg-secondary">
                      <th>#</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Celular</th>
                    <th>Dni</th>
                    <th>Usuario</th>

                    <th >Imagen</th>
                    <th >Opciones</th>
                  </tr>
                  <tr v-for="(usuario, index ) in arrayUsuario" :key="usuario.id" >

                    <td>{{index+1}}</td>
                    <td> {{usuario.nombre + ' ' + usuario.apellido}} </td>
                    <td> {{usuario.email}} </td>
                    <td>{{usuario.celular}}</td>
                    <td>{{usuario.dni}}</td>
                    <td>{{usuario.usuario}}</td>

                    <td>  <img :src="'img/usuario/' + usuario.imagen" class="img-fluid" width="100px" height="100px"> </td>

                    <td>
                        <button type="button" class="btn btn-warning btn-sm" @click="abrirModal('usuario','actualizar',usuario)">
                          <i class="fa fa-pen"></i>
                        </button> &nbsp;
                        <button  type="button" class="btn btn-danger btn-sm text-white" @click="eliminarUsuario(usuario.id)">
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
                <div class="col-md-6">
                        <label class="col-xs-3 form-control-label" for="email-input">Nombre </label>
                        <div class="col-xs-9">
                            <input type="text" v-model="nombre" class="form-control" placeholder="Ingrese su nombre">
                        </div>
                </div>
                    <div class="col-md-6">
                        <label class="col-xs-3 form-control-label" for="email-input">Apellidos</label>
                            <div class="col-xs-9">
                                <input type="text"  v-model="apellido" class="form-control" placeholder="Ingrese su apellido ">
                            </div>
                    </div>
                </div>

                  <div class="form-group row">
                    <div class="col-md-6">
                         <label class="col-md-3 form-control-label" for="text-input">Email</label>
                            <div class="col-xs-9">
                               <input type="email" v-model="email" class="form-control" placeholder="Ingrese su email">
                            </div>
                    </div>
                        <div class="col-md-6">
                            <label class="col-xs-3 form-control-label" for="email-input">DNI</label>
                                <div class="col-xs-9">
                                    <input type="text"  v-model="dni" class="form-control" placeholder="Ingrese su DNI ">
                                </div>
                        </div>
                    </div>

           <div class="form-group row">
                <div class="col-md-6">
                        <label class="col-xs-3 form-control-label" for="email-input">Celular </label>
                        <div class="col-xs-9">
                            <input type="number" v-model="celular" class="form-control" placeholder="Ingrese su numero de celular">
                        </div>
                </div>
                    <div class="col-md-6">
                        <label class="col-xs-3 form-control-label" for="email-input">Rol</label>
                            <div class="col-xs-9">
                                <select v-model="rol_id" class="form-control">
                                    <option value="1" selected disabled>Ingrese el rol</option>
                                    <option v-for="rol in arrayRol " :key="rol.id" :value="rol.id" v-text="rol.nombre"></option>
                                </select>
                            </div>
                    </div>
                </div>


           <div class="form-group row">
                <div class="col-md-6">
                        <label class="col-xs-3 form-control-label" for="email-input">Usuario </label>
                        <div class="col-xs-9">
                            <input type="text" v-model="usuario" class="form-control" placeholder="Ingrese su usuario">
                        </div>
                </div>
                    <div class="col-md-6">
                        <label class="col-xs-3 form-control-label" for="email-input">Contraseña</label>
                            <div class="col-xs-9">
                              <input type="password" v-model="password" class="form-control" placeholder="Ingrese su contraseña">
                            </div>
                    </div>
                </div>



              <template v-if="tipoAccion==0">
                    <div class="form-group row">

                        <!--poniendo :src se llama a la variable imagen que esta declarada en la propiedad data-->
                            <!--poner this.imagen=""; en cerrarModal para limpiar el campo ya que aparecia la imagen al registrar un registro-->
                        <label class="col-md-3 form-control-label"> Imagen de Usuario</label>
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
                      <label class="col-md-3 form-control-label"> Imagen de Usuario</label>
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
           <button v-if="tipoAccion == 0" type="button" class="btn btn-warning" @click="guardarUsuario()">Guardar</button>
           <button v-if="tipoAccion == 1" type="button" class="btn btn-success" @click="actualizarUsuario()">Actualizar</button>
         </div>
           <div v-show="errorUsuario" class="form-group row div-error m-0">

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

            arrayUsuario:[],
            pagination: [],
            arrayRol: [],
            modal:0,
            tituloModal: '',
            nombre: '',
            apellido:'',
            celular:0,
            dni:0,
            rol_id:'',
            email:'',
            usuario:'',
            password:'',
            imagen: '',
            tipoAccion: 0,
            usuario_id:0,
            criterio :'nombre',
            buscar: '',
            errorMostrarMsUsuario:[],
            errorUsuario:0,
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
        this.getUsuario(1, this.buscar, this.criterio);
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
        getUsuario(page, buscar, criterio){
            let me = this;
            var url = '/user?page='+page+'&buscar='+buscar+'&criterio='+criterio;
            axios.get(url).then((reponse)=>{
                console.log(reponse);
                var respuesta = reponse.data;
                me.arrayUsuario = respuesta.usuario.data;
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
                me.getUsuario(page, buscar, criterio);
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
            getRol(){
                let me = this;
                var url = '/rol/selectrol';
                axios.get(url).then((response)=>{
                    console.log(response);
                    var respuesta = response.data;
                    me.arrayRol = respuesta.rol;
                }).catch(error=>{
                    console.log(error);
                })
            },
        guardarUsuario(){
            if (this.validarUsuario()){
                    return;
                }
          let me = this;
          var url = '/user/agregar';
          axios.post(url,{
            'nombre': this.nombre,
            'apellido': this.apellido,
            'password': this.password,
            'rol_id':this.rol_id,
            'dni':this.dni,
            'celular':this.celular,
            'usuario':this.usuario,
            'imagen':this.imagen,
            'email':this.email
          }).then((response)=>{
            console.log(response);
            this.msgExitoso('guardado');
            this.cerrarModal();
            this.getUsuario(1,'','nombre');
          }).catch((error)=>{
            console.log(error);
          })

        },
        actualizarUsuario(){
              if (this.validarUsuario()){
                    return;
                }
            let me = this;
            var url = '/user/actualizar';
            axios.put(url, {
                'id' : this.usuario_id,
                 'nombre': this.nombre,
                'apellido': this.apellido,
                'password': this.password,
                'rol_id':this.rol_id,
                'dni':this.dni,
                'celular':this.celular,
                'usuario':this.usuario,
                'imagen':this.imagen,
                 'email':this.email
            }).then((reposne)=>{
                console.log(reposne);
                this.msgExitoso('actualizado');
                this.cerrarModal();
                this.getUsuario(1,'','nombre');
            }).catch((error)=>{
                console.log(error);
            })

        },
        eliminarUsuario(id){
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false,
            })
            swalWithBootstrapButtons.fire({
                title: 'Esta de seguro de eliminar esta Usuario?',

                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result)=>{
            if(result.value){
                let me = this;
                axios.put('user/eliminar',{
                'id':id
                }).then((response)=>{
                me.cerrarModal();
                me.getUsuario(1,'','nombre');
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
            case 'usuario':
            {
              switch(accion){
                case 'guardar' :
                {
                  this.modal=1;
                  this.tituloModal = 'Agregar nueva Usuario'
                  this.nombre = '';
                  this.apellido = '';
                  this.dni = '';
                  this.celular = '';
                  this.imagen = '';
                  this.email= '';
                  this.usuario='';
                  this.rol_id = '1';
                  this.password='';
                  this.tipoAccion = 0


                  break;
                }
                case 'actualizar':
                {
                  this.modal = 1;
                  this.tipoAccion = 1;
                  this.tituloModal = 'Actualizar Usuario';
                  this.usuario_id = data['id'];
                  this.nombre = data['nombre'];
                  this.apellido = data['apellido'];
                  this.dni = data['dni'];
                  this.email = data['email'];
                  this.celular = data['celular'];
                  this.usuario = data['usuario'];
                  this.password = data['password'];
                  this.rol_id = data['rol_id'];
                  this.imagen = data['imagen']

                  break;
                }
              }
            }
            this.getRol();
          }

        },
        cerrarModal(){
            this.modal = 0;
            this.nombre = '';
            this.apellido = '';
            this.dni = '';
            this.celular = '';
            this.imagen = '';
            this.email= '';
            this.usuario='';
            this.rol_id = '1';
            this.password='';

        },
        validarUsuario(){
            this.errorUsuario = 0;
            this.errorMostrarMsUsuario= [];

            if(this.nombre == '') this.errorMostrarMsUsuario.push('El nombre no puede estar vacio');
            if(this.imagen == '') this.errorMostrarMsUsuario.push('La descripciom no puede estar vacio');

            if(this.errorMostrarMsUsuario.length) this.errorUsuario = 1;

            if(this.errorUsuario == 1){

                this.errorMostrarMsUsuario.forEach((error) =>{
                    console.log(error);
                // this.msgError(error);
                 this.msgError('Los campos son obligatorios')
                });
                return this.errorUsuario ;


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
