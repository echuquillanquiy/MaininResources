<template>
  <div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">Usuario</h4>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    
    <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <template v-if="!fillVerUsuario.cRutaArchivo">
                                    <img src="/img/avatar.png" alt="Foto de usuario" class="profile-user-img img-fluid img-circle img-max-height">
                                </template>

                                <template v-else>
                                    <img :src="fillVerUsuario.cRutaArchivo" :alt="cNombreCompleto" class="profile-user-img img-fluid img-circle img-max-height">
                                </template>
                            </div>

                            <h3 class="profile-username text-center">{{ cNombreCompleto }}</h3>

                            <p class="text-muted text-center">Reclutador(a)</p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Sobre mí</h3>
                        </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-user"></i> Nombre Completo</strong>

                        <p class="text-muted" v-text="cNombreCompleto">
                        </p>

                        <hr>

                        <strong><i class="fas fa-envelope"></i> Correo Electronico</strong>

                        <p class="text-muted" v-text="fillVerUsuario.cCorreo"></p>

                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-md-8">
                <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills position-reverse">
                        <li class="nav-item ">
                            <router-link class="nav-link active" :to="'/usuarios'">
                                <i class="fas fa-arrow-left"></i> Regresar
                            </router-link>
                        </li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="settings">
                            <form class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Nombres</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" v-model="fillEditUsuario.cNombres" @keyup.enter="setEditarUsuario">
                                    </div>
                                </div>

                                
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Apellidos</label>
                                    <div class="col-md-8">
                                    <input type="text" class="form-control" v-model="fillEditUsuario.cApellidos" @keyup.enter="setEditarUsuario">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Usuario</label>
                                    <div class="col-md-8">
                                    <input type="text" class="form-control" v-model="fillEditUsuario.cUsuario" @keyup.enter="setEditarUsuario">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Correo Electronico</label>
                                    <div class="col-md-8">
                                    <input type="email" class="form-control" v-model="fillEditUsuario.cCorreo" @keyup.enter="setEditarUsuario">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Contraseña</label>
                                    <div class="col-md-8">
                                    <el-input placeholder="Ingrese una contraseña" v-model="fillEditUsuario.cContrasena" @keyup.enter="setEditarUsuario" show-password></el-input>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Fotografia</label>
                                    <div class="col-md-8">
                                    <input type="file" class="form-control" @change="getFile">
                                    </div>
                                </div>

                                <div class="form group row">
                                    <div class="col-sm-12">
                                        <button class="btn btn-flat btn-info btnFull" @click.prevent="setEditarUsuario" change="getFile" v-loading.fullscreen.lock="fullscreenLoading">Editar</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
                </div>
            </div>
    </div>

    <div class="modal fade" :class="{ show: modalShow }" :style=" modalShow ? mostrarModal : ocultarModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Mainin Recursos</h5>
                    <button class="close" @click="abrirModal"></button>
                </div>

                <div class="modal-body">
                    <div class="callout callout-danger bg-danger text-white" style="padding:5px;" v-for="(item, index) in mensajeError" :key="index" v-text="item"></div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" @click="abrirModal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

  </div>
</template>

<script>
export default {
    data() {
    return {
      fillEditUsuario: {
        nIdUsuario: this.$attrs.id,
        cNombres: '',
        cApellidos: '',
        cUsuario: '',
        cCorreo: '',
        cContrasena: '',
        oFotografia: ''
      },
      fillVerUsuario: {
        nIdUsuario: this.$attrs.id,
        cNombres: '',
        cApellidos: '',
        cUsuario: '',
        cCorreo: '',
        cContrasena: '',
        oFotografia: '',
        cRutaArchivo: ''
      },
      form: new FormData,
      fullscreenLoading: false,
      modalShow: false,
      mostrarModal: {
          display: 'block',
          background: '#0000006b'
      },
      ocultarModal: {
          display: 'none',
      },
      error: 0,
      mensajeError: []
    }
  },
  mounted() {
      this.getUsuarioById();
  },
  computed: {
    cNombreCompleto(){
        return this.fillVerUsuario.cNombres + ' ' + this.fillVerUsuario.cApellidos
    }
  },
  methods: {

      getUsuarioById(){
            this.fullscreenLoading = true;
            var url = '/administracion/usuario/getListUsuarios'
            axios.get(url, {
                params: {
                    'nIdUsuario': this.fillEditUsuario.nIdUsuario,
                
                }
            }).then(response => {
                this.getUsuarioEditar(response.data[0])
                this.getUsuarioVer(response.data[0])
                this.fullscreenLoading = false;
            })
      },

      getUsuarioEditar(data){
        this.fillEditUsuario.cNombres = data.firstname;
        this.fillEditUsuario.cApellidos = data.lastname;
        this.fillEditUsuario.cUsuario = data.username;
        this.fillEditUsuario.cCorreo = data.email;
      },

      getUsuarioVer(data){
        this.fillVerUsuario.cNombres = data.firstname;
        this.fillVerUsuario.cApellidos = data.lastname;
        this.fillVerUsuario.cUsuario = data.username;
        this.fillVerUsuario.cCorreo = data.email;
        this.fillVerUsuario.cRutaArchivo = data.profile_image;
      },
      abrirModal(){
          this.modalShow = !this.modalShow;
      },
      getFile(e) {
          this.fillEditUsuario.oFotografia = e.target.files[0];
      },

      setEditarUsuario() {
          if (this.validarRegistrarUsuario()) {
              this.modalShow = true;
              return;
          }

          this.fullscreenLoading = true;

          if (!this.fillEditUsuario.oFotografia || this.fillEditUsuario.oFotografia == undefined) {
              this.setGuardarUsuario(0);
          } else {
              this.setRegistrarArchivo();
          }
      },
      setRegistrarArchivo() {
          this.form.append('file', this.fillEditUsuario.oFotografia)
          const config = { header: { 'Content-Type': 'multipart/form-data' } };
          var url ='/archivo/setRegistrarArchivo'
          axios.post(url, this.form, config).then(response => {
              console.log(response)
              var nIdFile = response.data[0].nIdFile;
              this.setGuardarUsuario(nIdFile);
          })
      },

      setGuardarUsuario(nIdFile){
          var url = '/administracion/usuario/setEditarUsuario'
          axios.post(url,{
              'nIdUsuario' : this.fillEditUsuario.nIdUsuario,
              'cNombres' : this.fillEditUsuario.cNombres,
              'cApellidos' : this.fillEditUsuario.cApellidos,
              'cUsuario' : this.fillEditUsuario.cUsuario,
              'cCorreo' : this.fillEditUsuario.cCorreo,
              'cContrasena'   : this.fillEditUsuario.cContrasena,
              'oFotografia' : nIdFile,
          }).then(response => {
              this.fullscreenLoading = false;
              this.getUsuarioById();
                Swal.fire({
                    icon: 'success',
                    title: 'Se actualizo el usuario correctamente',
                    showConfirmButton: false,
                    timer: 1500
                })
          });
      },

      validarRegistrarUsuario() {
          this.error = 0;
          this.mensajeError = [];

          if(!this.fillEditUsuario.cNombres){
              this.mensajeError.push("El nombre es obligatorio");
          }
          if(!this.fillEditUsuario.cApellidos){
              this.mensajeError.push("El Apellido es obligatorio");
          }
          if(!this.fillEditUsuario.cUsuario){
              this.mensajeError.push("El nombre de Usuario es obligatorio");
          }
          if(!this.fillEditUsuario.cCorreo){
              this.mensajeError.push("El correo electronico es obligatorio");
          }

          if (this.mensajeError.length) {
              this.error = 1;
          }
          return this.error;

      }
  }
}
</script>

<style>
    .position-reverse{
        flex-direction: row-reverse;
    }
    .img-max-height{
        max-height: 100px !important;
    }
</style>