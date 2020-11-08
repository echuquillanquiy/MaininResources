<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark"> Crear Usuarios</h4>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-danger btn-sm" :to="'/usuarios'">
              <i class="fa fa-arrow-left"></i> Regresar
            </router-link>
          </div>
        </div>

        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Formulario Registro de Usuario</h3>
              </div>

              <div class="card-body">
                <form role="form">
                  <div class="row">

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Nombres</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillCrearUsuario.cNombres" @keyup.enter="setRegistrarUsuario">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Apellidos</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillCrearUsuario.cApellidos" @keyup.enter="setRegistrarUsuario">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Usuario</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillCrearUsuario.cUsuario" @keyup.enter="setRegistrarUsuario">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Correo Electronico</label>
                        <div class="col-md-9">
                          <input type="email" class="form-control" v-model="fillCrearUsuario.cCorreo" @keyup.enter="setRegistrarUsuario">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Contraseña</label>
                        <div class="col-md-9">
                          <el-input placeholder="Ingrese una contraseña" v-model="fillCrearUsuario.cContraseña" @keyup.enter="setRegistrarUsuario" show-password></el-input>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Fotografia</label>
                        <div class="col-md-9">
                          <input type="file" class="form-control" @change="getFile">
                        </div>
                      </div>
                    </div>

                  </div>
                </form>
              </div>

              <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button class="btn btn-flat btn-info btnWidth" @click.prevent="setRegistrarUsuario" v-loading.fullscreen.lock="fullscreenLoading">Registrar</button>
                    <button class="btn btn-flat btn-default btnWidth" @click.prevent="limpiarCriterios">Limpiar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
      fillCrearUsuario: {
        cNombres: '',
        cApellidos: '',
        cUsuario: '',
        cCorreo: '',
        cContraseña: '',
        oFotografia: ''
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

  computed: {

  },
  methods: {
      limpiarCriterios(){
          this.fillCrearUsuario.cNombres = '';
          this.fillCrearUsuario.cApellidos = '';
          this.fillCrearUsuario.cUsuario = '';
          this.fillCrearUsuario.cCorreo = '';
          this.fillCrearUsuario.cContraseña    = '';
          this.fillCrearUsuario.oFotografia    = '';
      },

      abrirModal(){
          this.modalShow = !this.modalShow;
      },

      getFile(e) {
          this.fillCrearUsuario.oFotografia = e.target.files[0];
      },

      setRegistrarUsuario() {
          if (this.validarRegistrarUsuario()) {
              this.modalShow = true;
              return;
          }

          this.fullscreenLoading = true;

          if (!this.fillCrearUsuario.oFotografia || this.fillCrearUsuario.oFotografia == undefined) {
              this.setGuardarUsuario(0);
          } else {
              this.setRegistrarArchivo();
          }
      },
      setRegistrarArchivo() {
          this.form.append('file', this.fillCrearUsuario.oFotografia)
          const config = { header: { 'Content-Type': 'multipart/form-data' } };
          var url ='/archivo/setRegistrarArchivo'
          axios.post(url, this.form, config).then(response => {
              console.log(response)
              var nIdFile = response.data[0].nIdFile;
              this.setGuardarUsuario(nIdFile);
          })
      },

      setGuardarUsuario(nIdFile){
          var url = '/administracion/usuario/setRegistrarUsuario'
          axios.post(url,{
              'cNombres' : this.fillCrearUsuario.cNombres,
              'cApellidos' : this.fillCrearUsuario.cApellidos,
              'cUsuario' : this.fillCrearUsuario.cUsuario,
              'cCorreo' : this.fillCrearUsuario.cCorreo,
              'cContraseña'   : this.fillCrearUsuario.cContraseña,
              'oFotografia' : nIdFile,
          }).then(response => {
              console.log("Registro de Usuario Exitoso");
              this.fullscreenLoading = false;
              this.$router.push('/usuarios');
          });
      },

      validarRegistrarUsuario() {
          this.error = 0;
          this.mensajeError = [];

          if(!this.fillCrearUsuario.cNombres){
              this.mensajeError.push("El nombre es obligatorio");
          }
          if(!this.fillCrearUsuario.cApellidos){
              this.mensajeError.push("El Apellido es obligatorio");
          }
          if(!this.fillCrearUsuario.cUsuario){
              this.mensajeError.push("El nombre de Usuario es obligatorio");
          }
          if(!this.fillCrearUsuario.cCorreo){
              this.mensajeError.push("El correo electronico es obligatorio");
          }
          if(!this.fillCrearUsuario.cContraseña){
              this.mensajeError.push("La contraseña es obligatoria");
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

</style>