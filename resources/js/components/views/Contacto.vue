<template>
    <div class="animated fadeIn">
        <div id="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d975.4901177794308!2d-75.23066407076522!3d-12.046240787893716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x1fec2a4c707f42f1!2sHostal%20Los%20Angeles!5e0!3m2!1ses!2spe!4v1586388400975!5m2!1ses!2spe" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div><!-- end map-->

        <div class="container_gray_bg">
            <div id="position">
                <div class="container">
                    <ul>
                        <li><a href="#">Contáctanos aqui</a></li>
                        <li><a href="#">Categoria</a></li>
                        <li>Pagina actual</li>
                    </ul>
                </div>
            </div><!-- Position -->
        <div class="contactanos">

            <div class="container margin_60 text-center">
                <div class="row ">

                    <div class="col-md-6">
                        <div class="box_style_1 box_estilo">
                            <div class="indent_title_in">
                                <i class="pe-7s-mail-open-file"></i>
                                <h3 class="titulo-seccion">Contáctanos</h3>

                            </div>
                            <div class="wrapper_indent" style="margin-top:60px">
                                <div id="message-contact"></div>
                                <form id="form-contacto">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">

                                                <input type="text" class="form-control styled input-pedido" v-model="nombre"  placeholder="Ingrese su nombre">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                         <div class="col-md-12 col-sm-12">
                                            <div class="form-group">

                                                <input type="text" class="form-control styled input-pedido" v-model="apellido"  placeholder="Ingrese sus Apellidos">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">

                                                <input type="email" v-model="email" class="form-control styled input-pedido" placeholder="Ingrese su correo electronico">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group">

                                                <input type="tel" v-model="celular" class="form-control styled input-pedido" placeholder="Ingrese su numero telefonico">
                                            </div>
                                        </div>
                                          <div class="col-md-6">
                                            <div class="form-group">

                                                  <v-select  v-model="asunto" placeholder="Ingrese el asunto" :options="['BOLETA','TICKET']"></v-select>
                                            </div>

                                        </div>
                                    </div>




                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">

                                                <textarea rows="5" v-model="mensaje" class="form-control styled input-pedido" style="height:100px;" placeholder="Escribe su mensaje aqui"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">

                                            </div>
                                        </div>
                                    </div>
                                       <button    class="button add_bottom_30" @click.prevent="postContacto()"><i class="fas " style="margin-right:10px" :class="{'fa-sync-alt fa-spin':loading}"></i> Enviar</button>
                                </form>
                            </div><!-- End wrapper_indent -->


                        </div><!-- End box style 1-->
                    </div><!-- End col-md-9 -->

                    <div class="col-md-6">
                        <div>
                            <img src="img/redes/logo.png" class="img-responsive" alt="" style="margin-top:70px">
                        </div>
                    </div>

                </div><!--End row -->
            </div><!--End container -->
        </div>
        </div><!--End container_gray_bg -->

        <ScrollUp :scroll-duration="1000" />

    </div>
</template>
<script>
import ScrollUp from 'vue-scroll-up';
import "vue-scroll-up/dist/style.css";
 import vSelect from 'vue-select';
    import 'vue-select/dist/vue-select.css';
export default {
    data() {
        return {
            nombre:'',
            apellido:'',
            email:'',
            celular:'',
            asunto:'',
            mensaje:'',
            loading: false
        }
    },
    methods: {
        postContacto(){
            this.loading = true;
           setTimeout(() => {
                let me= this;
            var url = '/contacto/registrar';
            axios.post(url,{
                'nombre':this.nombre,
                'apellido':this.apellido,
                'email':this.email,
                'celular':this.celular,
                'asunto':this.asunto,
                'mensaje':this.mensaje,
            }).then((response)=>{
                     this.loading = false;
                     Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: 'Pronto nos pondremos en contacto contigo!!!',
                    showConfirmButton: false,
                    timer: 3000
                    });
                    this.nombre = '';
                    this.apellido = '';
                    this.celular = '';
                    this.email = '';
                    this.asunto = '';
                    this.mensaje = ''
            }).catch((error)=>{
                this.loading = false
                console.log(error);
                 Swal.fire({
                    position: 'center',
                    type: 'error',
                    title: 'Todos los campos son requeridos',
                    showConfirmButton: false,
                    timer: 3000
                    });
            })
           }, 500);
        }

    },
    components:{
        ScrollUp,
        vSelect
    }
}
</script>

<style >
    .vs__dropdown-toggle {

    border-radius: 10px;
    height: 40px;


}
.box_estilo{
    background: transparent;
    border: 2px solid #e1e1e1;
    -webkit-box-shadow: 3px 3px 44px -16px rgba(0,0,0,0.75);
        -moz-box-shadow: 3px 3px 44px -16px rgba(0,0,0,0.75);
        box-shadow: 3px 3px 44px -16px rgba(0,0,0,0.75);
        margin: 0;
}
.vs--searchable .vs__dropdown-toggle {
    cursor: text;
    background: #fff;}
    .pe-7s-mail-open-file:before {
    content: "\e63b";
    color: #fff;
    font-size: 8rem;
}
</style>
