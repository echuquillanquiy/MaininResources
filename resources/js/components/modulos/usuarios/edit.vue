<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark"> Editar Usuario</h4>
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
                <h3 class="card-title">Formulario Editar Usuario</h3>
              </div>

              <div class="card-body">
                <form role="form">
                  <div class="row">

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Nombres</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillEditUsuario.cNombres" @keyup.enter="setEditarUsuario">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Apellidos</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillEditUsuario.cApellidos" @keyup.enter="setEditarUsuario">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Usuario</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillEditUsuario.cUsuario" @keyup.enter="setEditarUsuario">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Correo Electronico</label>
                        <div class="col-md-9">
                          <input type="email" class="form-control" v-model="fillEditUsuario.cCorreo" @keyup.enter="setEditarUsuario">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Contraseña</label>
                        <div class="col-md-9">
                          <el-input placeholder="Ingrese una contraseña" v-model="fillEditUsuario.cContrasena" @keyup.enter="setEditarUsuario" show-password></el-input>
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
                    <button class="btn btn-flat btn-info btnWidth" @click.prevent="setEditarUsuario" v-loading.fullscreen.lock="fullscreenLoading">Editar</button>
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
      fillEditUsuario: {
        nIdUsuario: this.$attrs.id,
        cNombres: '',
        cApellidos: '',
        cUsuario: '',
        cCorreo: '',
        cContrasena: '',
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

  mounted() {
      this.getUsuarioById();
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
                console.log(response);
                this.fillEditUsuario.cNombres = response.data[0].firstname;
                this.fillEditUsuario.cApellidos = response.data[0].lastname;
                this.fillEditUsuario.cUsuario = response.data[0].username;
                this.fillEditUsuario.cCorreo = response.data[0].email;
                this.fullscreenLoading = false;
            })
      },

      limpiarCriterios(){
          this.fillEditUsuario.cNombres = '';
          this.fillEditUsuario.cApellidos = '';
          this.fillEditUsuario.cUsuario = '';
          this.fillEditUsuario.cCorreo = '';
          this.fillEditUsuario.cContrasena    = '';
          this.fillEditUsuario.oFotografia    = '';
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

</style>