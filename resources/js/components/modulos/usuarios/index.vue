<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">Usuarios</h4>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="content container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <router-link class="btn btn-info btn-sm" :to="'/'">
              <i class="fa fa-plus-square"></i> Nuevo Usuario
            </router-link>
          </div>
        </div>

        <div class="card-body">
          <div class="container-fluid">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Criterios de Búsqueda</h3>
              </div>

              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Nombre</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillBsqUsuario.cNombre">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Usuario</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillBsqUsuario.cUsuario">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Correo electronico</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillBsqUsuario.cCorreo">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Estado</label>
                        <div class="col-md-9">
                          <el-select v-model="fillBsqUsuario.cEstado" 
                            placeholder="Seleccione un estado"
                            clearable>
                            <el-option
                              v-for="item in listEstados"
                              :key="item.value"
                              :label="item.label"
                              :value="item.value">
                            </el-option>
                          </el-select>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>

              <div class="card-footer">
                <div class="row">
                  <div class="col-md-4 offset-4">
                    <button class="btn btn-flat btn-info btnWidth" @click.prevent="getListUsuarios">Buscar</button>
                    <button class="btn btn-flat btn-default btnWidth" @click.prevent="limpiarCriteriosBsq">Limpiar</button>
                  </div>
                </div>
              </div>

              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Bandeja de resultados</h3>
                </div>
                  <div class="card-body table-responsive">
                    <table class="table table-hover table-head-fixed text-nowrap projects text-center">
                      <thead>
                        <tr>
                          <th>Fotografía</th>
                          <th>Nombre</th>
                          <th>Correo</th>
                          <th>Usuario</th>
                          <th>Estado</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <img src="" alt="">
                          </td>
                          <td>Eduardo Chuquillanqui</td>
                          <td>echuquillanquiy@gmail.com</td>
                          <td>echuquillanquiy</td>
                          <td>
                            <span class="badge badge-success">Activo</span>
                          </td>
                          <td>
                            <router-link class="btn btn-primary btn-sm" :to="'/'">
                              <i class="fas fa-folder"></i> Ver
                            </router-link>
                            <router-link class="btn btn-info btn-sm" :to="'/'">
                              <i class="fas fa-pencil-alt"></i> Editar
                            </router-link>
                            <router-link class="btn btn-success btn-sm" :to="'/'">
                              <i class="fas fa-key"></i> Permiso
                            </router-link>
                            <router-link class="btn btn-danger btn-sm" :to="'/'">
                              <i class="fas fa-lock"></i> Desactivar
                            </router-link>
                            <router-link class="btn btn-success btn-sm" :to="'/'">
                              <i class="fas fa-lock-open"></i> Activar
                            </router-link>
                          </td>

                        </tr>
                      </tbody>
                    </table>
                    <div class="card-footer clearfix">
                      <ul class="pagination pagination-sm m-0 float-right">
                        <li class="page-item">
                          <a href="#" class="page-link">Anterior</a>
                        </li>
                        <li class="page-item active">
                          <a href="#" class="page-link">1</a>
                        </li>
                        <li class="page-item">
                          <a href="#" class="page-link">Posterior</a>
                        </li>
                      </ul>
                    </div>
                  </div>
              </div>
            </div>
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
      fillBsqUsuario: {
        cNombre: '',
        cUsuario: '',
        cCorreo: '',
        cEstado: ''
      },
      listUsuarios:[],
      listEstados: [
        {value: 'A', label: 'Activo'},
        {value: 'I', label: 'Inactivo'}
      ]
    }
  },
  methods: {
    limpiarCriteriosBsq(){
      this.fillBsqUsuario.cNombre    = '';
      this.fillBsqUsuario.cUsuario   = '';
      this.fillBsqUsuario.cCorreo    = '';
      this.fillBsqUsuario.cEstado    = '';
    },
    limpiarBandejaUsuarios() {
      this.listUsuarios = [];
    },
    getListUsuarios() {
      var url = '/administracion/usuario/getListUsuarios'
      axios.get(url, {
        params: {
          'cNombre'   : this.fillBsqUsuario.cNombre,
          'cUsuario'   : this.fillBsqUsuario.cUsuario,
          'cCorreo'   : this.fillBsqUsuario.cCorreo,
          'cEstado'   : this.fillBsqUsuario.cEstado
        }
      }).then(response => {
        console.log(response.data)
      })
    }
  }
}
</script>

<style>

</style>