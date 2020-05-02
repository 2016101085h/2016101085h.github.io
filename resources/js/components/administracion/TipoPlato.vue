<template>
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">



    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tipo de Plato</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Escritorio</a></li>
              <li class="breadcrumb-item active">Tipo de Platos</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                  <i class="fa fa-align-justify"></i> Tipos
                  <button type="button" class="btn btn-secondary bg-info ml-2 border-transparent " @click="abrirModal('tipo','guardar')  ">
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
                      <input type="text" v-model="buscar" @keyup.prevent="getTipo(1,buscar, criterio)" class="form-control" placeholder="Texto a buscar">
                      <button type="submit" class="btn btn-warning text-white rounded-0" @click="getTipo(1, buscar, criterio)"><i class="fa fa-search"></i> Buscar</button>
                    </div>
                  </div>
                </div>
                <table class="table table-striped table-hover">
                  <tr class="bg-secondary">
                      <th>#</th>
                    <th>Nombre</th>
                    <th >Estado</th>
                    <th >Opciones</th>
                  </tr>
                  <tr v-for="(tipo, index ) in arrayTipo" :key="tipo.id" >

                    <td>{{index+1}}</td>
                    <td> {{tipo.nombre}} </td>

                    <td>
                        <span v-if="tipo.condicion == '1'" class="badge bg-success">Activo</span>
                        <span v-if="tipo.condicion == '0'" class="badge bg-danger">Inactivo</span>
                    </td>
                    <td>
                        <button type="button" class="btn btn-warning btn-sm" @click="abrirModal('tipo','actualizar',tipo)">
                          <i class="fa fa-pen"></i>
                        </button> &nbsp;
                        <button v-if="tipo.condicion == '1'" type="button" class="btn btn-danger btn-sm text-white" @click="desactivarTipo(tipo.id)">
                          <i class="fa fa-trash"></i>
                        </button>
                        <button  v-if="tipo.condicion == '0'" type="button" class="btn btn-primary btn-sm" @click="activarTipo(tipo.id)">
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
                 <input type="text" v-model="nombre" class="form-control" placeholder="Nombre de Tipo de Plato">
                 <!-- <span class="help-block">(*) Ingrese el nombre de la categoría</span> -->
               </div>
             </div>

           </form>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-danger" @click="cerrarModal()">Cerrar</button>
           <button v-if="tipoAccion == 0" type="button" class="btn btn-warning" @click="guardarTipo()">Guardar</button>
           <button v-if="tipoAccion == 1" type="button" class="btn btn-success" @click="actualizarTipo()">Actualizar</button>
         </div>
           <div v-show="errorTipo" class="form-group row div-error m-0">

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
            arrayTipo:[],
            pagination: [],
            modal:0,
            tituloModal: '',
            nombre: '',
            descripcion: '',
            tipoAccion: 0,
            tipo_id:0,
            criterio :'nombre',
            buscar: '',
            errorMostrarMsTipo:[],
            errorTipo:0,
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
        this.getTipo(1, this.buscar, this.criterio);
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
        getTipo(page, buscar, criterio){
            let me = this;
            var url = '/tipo-plato?page='+page+'&buscar='+buscar+'&criterio='+criterio;
            axios.get(url).then((reponse)=>{
                console.log(reponse);
                var respuesta = reponse.data;
                me.arrayTipo = respuesta.tipo.data;
                me.pagination = respuesta.pagination;

            }).catch((error)=>{

            })
        },
         cambiarpagina(page, buscar, criterio){
                let me = this;
                me.pagination.current_page = page;
                me.getTipo(page, buscar, criterio);
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
        guardarTipo(){
            if (this.validarTipo()){
                    return;
                }
          let me = this;
          var url = '/tipo-plato/agregar';
          axios.post(url,{
            'nombre': this.nombre

          }).then((response)=>{
            console.log(response);
            this.msgExitoso('guardado');
            this.cerrarModal();
            this.getTipo(1,'','nombre');
          }).catch((error)=>{
            console.log(error);
          })

        },
        actualizarTipo(){
            if (this.validarTipo()){
                    return;
                }
            let me = this;
            var url = '/tipo-plato/actualizar';
            axios.put(url, {
                'id' : this.tipo_id,
                'nombre':this.nombre

            }).then((reposne)=>{
                console.log(reposne);
                this.msgExitoso('actualizado');
                this.cerrarModal();
                this.getTipo(1,'','nombre');
            }).catch((error)=>{
                console.log(error);
            })

        },
        desactivarTipo(id){
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false,
            })
            swalWithBootstrapButtons.fire({
                title: 'Esta de seguro de desactivar este Tipo de Plato?',

                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result)=>{
            if(result.value){
                let me = this;
                axios.put('/tipo-plato/desactivar',{
                'id':id
                }).then((response)=>{
                me.cerrarModal();
                me.getTipo(1,'','nombre');
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
        activarTipo(id){
                 const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
                })
                swalWithBootstrapButtons.fire({
                    title: 'Esta de seguro de activar este Tipo de Plato?',

                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then((result)=>{
                if(result.value){
                    let me = this;
                    axios.put('tipo-plato/activar',{
                    'id':id
                    }).then((response)=>{
                    me.cerrarModal();
                    me.getTipo(1,'','nombre');
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
            case 'tipo':
            {
              switch(accion){
                case 'guardar' :
                {
                  this.modal=1;
                  this.tituloModal = 'Agregar nuevo Tipo de Plato'
                  this.nombre = '';
                  this.tipoAccion = 0


                  break;
                }
                case 'actualizar':
                {
                  this.modal = 1;
                  this.tipoAccion = 1;
                  this.tituloModal = 'Actualizar Tipo de Plato';
                  this.tipo_id = data['id'];
                  this.nombre = data['nombre'];
                //   this.descripcion = data['descripciom'];
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


        },
        validarTipo(){
            this.errorTipo = 0;
            this.errorMostrarMsTipo= [];

            if(this.nombre == '') this.errorMostrarMsTipo.push('El nombre no puede estar vacio');
            // if(this.descripcion == '') this.errorMostrarMsRTipo.push('La descripciom no puede estar vacio');

            if(this.errorMostrarMsTipo.length) this.errorTipo = 1;

            if(this.errorTipo == 1){

                this.errorMostrarMsTipo.forEach((error) =>{
                    console.log(error);
                // this.msgError(error);
                 this.msgError('Los campos son obligatorios')
                });
                return this.errorTipo ;


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
