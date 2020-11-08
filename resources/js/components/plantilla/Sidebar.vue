<template>
  <aside class="main-sidebar sidebar-dark-primary elevation-4 text-sm">
        <!-- Brand Logo -->
        <a href="../../index3.html" class="brand-link">
        <img :src="ruta + '/img/AdminLTELogo.png'"
            alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Mainin</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            <img :src="ruta + '/img/avatar.png'" class="img-circle elevation-2" alt="Eduardo Chuquillanqui">
            </div>
            <div class="info">
            <a href="#" class="d-block">Eduardo Chuquillanqui</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview menu-open">
                <router-link class="nav-link" :to="'/'">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </router-link>
            </li>

            <li class="nav-header">OPERACIONES</li>

            <li class="nav-item has-treeview">
                <a class="nav-link">
                <i class="nav-icon fas fa-cog text-info"></i>
                <p>
                    Sistema
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="'/usuarios'">
                        <i class="nav-icon far fa-circle nav-icon"></i>
                        <p>
                            Usuarios
                        </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link class="nav-link" :to="'/permiso'">
                        <i class="nav-icon far fa-circle nav-icon"></i>
                        <p>
                            Permisos
                        </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link class="nav-link" :to="'/rol'">
                        <i class="nav-icon far fa-circle nav-icon"></i>
                        <p>
                            Roles
                        </p>
                        </router-link>
                    </li>
                        </ul>
            </li>

            <li class="nav-item">
                <router-link class="nav-link" :to="'/puestos'">
                <i class="nav-icon fas fa-hard-hat text-danger"></i>
                <p>
                    Puestos
                </p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="'/empresas'">
                <i class="nav-icon fas fa-building text-warning"></i>
                <p>
                    Empresas Clientes
                </p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="'/categorias'">
                <i class="nav-icon far fa-calendar-plus text-white"></i>
                <p>
                    Categorías
                </p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="'/montos'">
                <i class="nav-icon fas fa-file-invoice-dollar text-success"></i>
                <p>
                    Montos por Puesto
                </p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="'/areas'">
                <i class="nav-icon fas fa-layer-group text-purple"></i>
                <p>
                    Áreas
                </p>
                </router-link>
            </li>

            

                    <li class="nav-item has-treeview">
                        <a class="nav-link">
                        <i class="nav-icon fas fa-users text-info"></i>
                        <p>
                            Colaboradores
                            <i class="fas fa-angle-left right"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <router-link class="nav-link" :to="'/colaboradores'">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Administración</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" :to="'/capacitaciones'">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Capacitaciones</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" :to="'/dmedicos'">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Datos Médicos</p>
                                </router-link>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <router-link class="nav-link" :to="'/reporte'">
                        <i class="nav-icon far fa-file-alt text-success"></i>
                        <p>
                            Reportes
                        </p>
                        </router-link>
                    </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>

<script>
export default {
    props: ['ruta']
}
</script>

<style>

</style>