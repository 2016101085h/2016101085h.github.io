/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
// window.$ = window.jQuery = require('jquery');
window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('enlace', require('./components/includes/Enlace.vue').default);
Vue.component('features', require('./components/includes/Features.vue').default);
Vue.component('servicios', require('./components/includes/Servicios.vue').default);
Vue.component('slider', require('./components/includes/Slider.vue').default);
Vue.component('pedido', require('./components/includes/Pedido.vue').default);
Vue.component('carta-pedido', require('./components/includes/Carta-pedido.vue').default);
Vue.component('info-plato', require('./components/includes/Info-plato.vue').default);


// ADMINISTRACION

Vue.component('rol', require('./components/administracion/Rol.vue').default);
Vue.component('tipo-plato', require('./components/administracion/TipoPlato.vue').default);
Vue.component('portada', require('./components/administracion/Portada.vue').default);
Vue.component('entrada', require('./components/administracion/Entrada.vue').default);
Vue.component('sopa', require('./components/administracion/Sopa.vue').default);
Vue.component('bebida', require('./components/administracion/Bebida.vue').default);
Vue.component('platos', require('./components/administracion/Plato.vue').default);
Vue.component('contacto', require('./components/administracion/Contacto.vue').default);
Vue.component('pedidos', require('./components/administracion/Pedidos.vue').default);
Vue.component('usuario', require('./components/administracion/Usuario.vue').default);
Vue.component('notificacion', require('./components/administracion/Notificaciones.vue').default);
Vue.component('calendario', require('./components/administracion/Calendario.vue').default);
// Vue.component('carta-platos', require('./components/administracion/Plato.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import Vuex from 'vuex'

Vue.use(Vuex)
import router from './routes'
import EventBus from './event-bus'
import Axios from 'axios';
import Echo from 'laravel-echo';

const app = new Vue({
    el: '#app',
    router,
    data:{
        menu:0,
        modalabierto : 0,
        notificacion:[]
    },
     created() {
         let me = this;

         EventBus.$on('modal', data => {
             me.modalabierto = data
         })
         Axios.post('notificacion/get').then((response)=>{
            // console.log(response);

            // console.log(me.notificacion);
         }).catch((error)=>{
            //  console.log(error)
         })
         var userId = $('meta[name="userId"]').attr('content');
         window.Echo.private(`App.User.${userId}`).notification((notification) => {
                //  console.log(notification.data.datos);
                //  console.log(this.notificacion)
                this.notificacion.unshift(notification)
             });
     },


});



