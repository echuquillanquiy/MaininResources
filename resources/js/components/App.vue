
<template>
  <div>
        <Navbar :ruta="ruta"></Navbar>
    <!-- Main Sidebar Container -->
        <Sidebar :ruta="ruta"></Sidebar>
        <div class="content-wrapper">
            <transition name="slide-fade" mode="out-in">
                <router-view></router-view>
            </transition>
        </div>
        

        <Footer :ruta="ruta"></Footer>
 
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
</template>

<script>
    import Navbar from './plantilla/Nabvar'
    import Sidebar from './plantilla/Sidebar'
    import Footer from './plantilla/Footer'
    export default {
        props: ['ruta'],
        components: {
            Navbar,
            Sidebar,
            Footer
        }
    }
</script>

<style>

</style>