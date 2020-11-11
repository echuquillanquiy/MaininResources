import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
    routes:[
        { path: '/', component: require('./components/modulos/dashboard/index').default },
        { path: '/puestos', component: require('./components/modulos/puestos/index').default },
        { path: '/empresas', component: require('./components/modulos/empresas/index').default },
        { path: '/categorias', component: require('./components/modulos/categorias/index').default },
        { path: '/montos', component: require('./components/modulos/montos/index').default },
        { path: '/areas', component: require('./components/modulos/areas/index').default },

        { path: '/usuarios', component: require('./components/modulos/usuarios/index').default },
        { path: '/usuarios/crear', component: require('./components/modulos/usuarios/create').default },
        { 
            path: '/usuarios/editar/:id',
            name: 'usuarios.editar',
            component: require('./components/modulos/usuarios/edit').default,
            props: true
        },

        { 
            path: '/usuarios/ver/:id',
            name: 'usuarios.ver',
            component: require('./components/modulos/usuarios/view').default,
            props: true
        },
        
        { path: '/permiso', component: require('./components/modulos/permiso/index').default },

        { path: '/rol', component: require('./components/modulos/rol/index').default },
        { path: '/rol/crear', component: require('./components/modulos/rol/create').default },
        
        { path: '/reporte', component: require('./components/modulos/reporte/index').default },

        { path: '/colaboradores', component: require('./components/modulos/colaboradores/index').default },
        { path: '/capacitaciones', component: require('./components/modulos/colaboradores/capacitaciones/index').default },
        { path: '/dmedicos', component: require('./components/modulos/colaboradores/dmedicos/index').default },
    ],
    mode: 'history',
    linkActiveClass: 'active'
})