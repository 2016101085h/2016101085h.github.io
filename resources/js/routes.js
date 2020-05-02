import Vue from 'vue';
import Router from 'vue-router';
Vue.use(Router);
export default new Router({
    // mode:'history',
    routes:[
        {path:'/inicio', name:'inicio', component:require('./components/views/Index.vue').default},
        {path:'/about', name:'about', component: require('./components/views/About.vue').default},
        {path:'/galeria', name:'galeria', component: require('./components/views/Galeria.vue').default},
        {path:'/contacto', name:'contacto', component: require('./components/views/Contacto.vue').default},
        {path:'/nuestra-carta', name:'nuestra-carta', component: require('./components/views/Servicios.vue').default},
        //  {path:'/nuestra-carta/pedido', name:'servicios', component: require('./components/views/Carta-pedido.vue').default},
        {path:'/admin', name:'admin', component: require('./components/administracion/Rol.vue').default},


        {path:'/', redirect: '/inicio'},


    ]
})
