<template>
          <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" @click="check()" href="#" data-target="#notificacion">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">{{notify.length}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="notificacion">

          <div class="dropdown-divider"></div>
         <div v-if="notify.length">
              <a href="#" class="dropdown-item" v-for="item in listar" :key="item.id">
            <i class="fas fa-envelope mr-2"></i> {{item.pedidos.msj}}
            <span class="float-right text-white text-sm  badge badge-info ">{{item.pedidos.numero + ' nuevos'}}</span>
            </a>
         </div>

          <div class="dropdown-divider"></div>


          <div class="dropdown-divider"></div>
          <a v-if="notify.length == 0" href="#" class="dropdown-item dropdown-footer">No tiene notificaciones</a>
        </div>
      </li>
</template>
<script>

export default {
    data() {
        return {
            arrayNotificaciones: [],
            notify: []
        }
    },
    props:['notificacion'],
    methods: {
        check(){
            setTimeout(() => {
                this.notify = []
            }, 3000);
        }
    },
    beforeUpdate() {
        if(this.notify.length > 0){
               Swal.fire({
                    position: 'center',
                    type: 'info',
                    title: 'Tienes un pedido pendiente de revisión',
                    showConfirmButton: false,

                    timer: 5000
                    });
        }
    },
    computed: {
        listar: function(){
            // return this.notificacion[0];
            this.arrayNotificaciones = Object.values(this.notificacion[0]);
            // return Object.values(thos.arrayNotificaciones[0]);
            if(this.notificacion  == ''){
                return this.arrayNotificaciones = []
            }else{
                this.arrayNotificaciones = Object.values(this.notificacion[0]);
                if(this.arrayNotificaciones.length > 3){
                    return Object.values(this.arrayNotificaciones[4]);
                }else{
                    return Object.values(this.arrayNotificaciones[0]);

                }
            }
        },

    },
            mounted() {
                this.notify = this.notificacion;

            },
}
</script>
