<template>
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">



    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Atencion de sección de contáctanos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Escritorio</a></li>
              <li class="breadcrumb-item active">Contacto</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                  <i class="fa fa-align-justify"></i> Contactos

                </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <div class="form-group row">
                  <div class="col-md-6">
                    <div class="input-group">
                      <select class="form-control col-md-3" v-model="criterio">
                        <option value="nombre">Nombre</option>

                      </select>
                      <input  type="text" v-model="buscar" @keyup.prevent="getContacto(1,buscar, criterio)" class="form-control" placeholder="Texto a buscar">
                      <button type="submit" class="btn btn-warning text-white rounded-0" @click="getContacto(1, buscar, criterio)"><i class="fa fa-search"></i> Buscar</button>
                    </div>
                  </div>
                </div>
                <table class="table table-striped table-hover ">
                  <tr class="bg-secondary">
                      <th>#</th>
                    <th>Apellidos y nombres</th>
                    <th>Email</th>
                    <th>Celular</th>
                    <th>Asunto</th>
                    <th>Mensaje</th>
                    <th >Estado</th>
                    <th >Opciones</th>
                  </tr>
                  <tr v-for="(contacto, index ) in arrayContacto" :key="contacto.id" >

                    <td>{{index+1}}</td>
                    <td>{{contacto.apellido + ' ' +contacto.nombre}} </td>
                    <td> {{contacto.email}} </td>
                    <td> {{contacto.celular}} </td>
                    <td> {{contacto.asunto}} </td>
                    <td> <p class="form-control">{{contacto.mensaje}} </p> </td>
                    <td>
                        <span v-if="contacto.estado == '1'" class="badge bg-danger">Pendiente</span>
                        <span v-if="contacto.estado == '0'" class="badge bg-info">Revisado</span>
                    </td>
                    <td>

                        <button v-if="contacto.estado == '1'" type="button" class="btn btn-success btn-sm text-white" @click="atenderContacto(contacto.id)">
                          <i class="fa fa-trash"></i>
                        </button>
                        <button v-if="contacto.estado == '0'" type="button" class="btn btn-warning btn-sm text-white" @click="desatenderContacto(contacto.id)">
                          <i class="fa fa-edit"></i>
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

  </div>
  <!-- /.content-wrapper -->

</template>
<script>
export default {
    data() {
        return {

            arrayContacto:[],
            pagination: [],
            criterio :'nombre',
            buscar: '',
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
        this.getContacto(1, this.buscar, this.criterio);
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
        getContacto(page, buscar, criterio){
            let me = this;
            var url = '/contacto?page='+page+'&buscar='+buscar+'&criterio='+criterio;
            axios.get(url).then((reponse)=>{
                console.log(reponse);
                var respuesta = reponse.data;
                me.arrayContacto = respuesta.contacto.data;
                me.pagination = respuesta.pagination;

            }).catch((error)=>{

            })
        },
         cambiarpagina(page, buscar, criterio){
                let me = this;
                me.pagination.current_page = page;
                me.getContacto(page, buscar, criterio);
            },



        desatenderContacto(id){
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false,
            })
            swalWithBootstrapButtons.fire({
                title: 'Esta de seguro de desatender este Contacto?',

                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result)=>{
            if(result.value){
                let me = this;
                axios.put('contacto/desatender',{
                'id':id
                }).then((response)=>{

                me.getContacto(1,'','nombre');
                swalWithBootstrapButtons.fire(
                'Atendido!',
                'El registro ha sido atendido con exito.',
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
        atenderContacto(id){
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
                axios.put('contacto/atender',{
                'id':id
                }).then((response)=>{

                me.getContacto(1,'','nombre');
                swalWithBootstrapButtons.fire(
                'Atendido!',
                'El registro ha sido atendido con exito.',
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




    },
}
</script>
