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
            <router-link class="btn btn-info btn-sm" :to="'/usuarios/crear'">
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
                          <input type="text" class="form-control" v-model="fillBsqUsuario.cNombre" @keyup.enter="getListUsuarios">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Usuario</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillBsqUsuario.cUsuario" @keyup.enter="getListUsuarios">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-md-3 col-form-label">Correo electronico</label>
                        <div class="col-md-9">
                          <input type="text" class="form-control" v-model="fillBsqUsuario.cCorreo" @keyup.enter="getListUsuarios">
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
                              :value="item.value"
                              >
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
                    <button class="btn btn-flat btn-info btnWidth" @click.prevent="getListUsuarios" v-loading.fullscreen.lock="fullscreenLoading">Buscar</button>
                    <button class="btn btn-flat btn-default btnWidth" @click.prevent="limpiarCriteriosBsq">Limpiar</button>
                  </div>
                </div>
              </div>

              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Bandeja de resultados</h3>
                </div>
                  <div class="card-body table-responsive">
                    <template v-if="listarUsuariosPaginated.length">
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
                        <tr v-for="(item, index) in listarUsuariosPaginated" :key="index">
                          <td>
                            <template v-if="!item.profile_image">
                              <li class="user-block">
                                <img src="/img/avatar.png" :alt="item.username" class="profile-avatar-img img-fluid img-circle">
                              </li>
                            </template>

                            <template v-else>
                              <li class="user-block">
                                <img :src="item.profile_image" :alt="item.username" class="profile-avatar-img img-fluid img-circle">
                              </li>
                            </template>
                          </td>
                          <td v-text="item.fullname"></td>
                          <td v-text="item.email"></td>
                          <td v-text="item.username"></td>
                          <td>
                            <template v-if="item.state == 'A'">
                              <span class="badge badge-success" v-text="item.state_alias"></span>
                            </template>

                            <template v-else>
                              <span class="badge badge-danger" v-text="item.state_alias"></span>
                            </template>
                          </td>
                          <td>
                            <router-link class="btn btn-flat btn-primary btn-sm" :to="{ name:'usuarios.ver', params: {id: item.id }}">
                              <i class="fas fa-folder"></i> Ver
                            </router-link>

                            <template v-if="item.state == 'A'">
                              <router-link class="btn btn-flat btn-info btn-sm" :to="{ name:'usuarios.editar', params: {id: item.id }}">
                                <i class="fas fa-pencil-alt"></i> Editar
                              </router-link>
                              <router-link class="btn btn-flat btn-success btn-sm" :to="'/'">
                                <i class="fas fa-key"></i> Permiso
                              </router-link>
                              <button class="btn btn-flat btn-danger btn-sm" @click.prevent="setCambiarEstadoUsuario(1, item.id)">
                                <i class="fas fa-lock"></i> Desactivar
                              </button>
                            </template>

                            <template v-else>
                              <button class="btn btn-flat btn-success btn-sm"  @click.prevent="setCambiarEstadoUsuario(2, item.id)">
                                <i class="fas fa-lock-open"></i> Activar
                              </button>
                            </template>
                          </td>

                        </tr>
                      </tbody>
                      </table>
                      <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-left">
                          <li class="page-item" v-if="pageNumber > 0">
                            <a href="#" class="page-link" @click.prevent="prevPage">Anterior</a>
                          </li>
                          <li class="page-item" 
                          v-for="(page, index) in pagesList" :key="index"
                          :class="[page == pageNumber ? 'active' : '']">
                            <a href="#" class="page-link" @click.prevent="selectPage(page)">{{ page + 1 }}</a>
                          </li>
                          <li class="page-item" v-if="pageNumber < pageCount - 1">
                            <a href="#" class="page-link" @click.prevent="nextPage">Posterior</a>
                          </li>
                        </ul>
                      </div>
                    </template>

                    <template v-else>
                      <div class="callout callout-info">
                        <h5>No se encontraron resultados...</h5>
                      </div>
                    </template>
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
      ],
      fullscreenLoading: false,
      pageNumber: 0,
      perPage: 5
    }
  },

  computed: {
    pageCount() {
      let a = this.listUsuarios.length,
          b = this.perPage;
      return Math.ceil(a / b);
    },
    listarUsuariosPaginated() {
      let inicio = this.pageNumber * this.perPage,
          fin = inicio + this.perPage;
      return this.listUsuarios.slice(inicio, fin);
    },
    pagesList() {
      let a = this.listUsuarios.length,
          b = this.perPage;
      let pageCount =  Math.ceil(a / b);
      let count = 0,
          pagesArray = [];

          while (count < pageCount) {
            pagesArray.push(count);
            count++;
          }
          return pagesArray;
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
      this.fullscreenLoading = true;
      var url = '/administracion/usuario/getListUsuarios'
      axios.get(url, {
        params: {
          'cNombre'   : this.fillBsqUsuario.cNombre,
          'cUsuario'   : this.fillBsqUsuario.cUsuario,
          'cCorreo'   : this.fillBsqUsuario.cCorreo,
          'cEstado'   : this.fillBsqUsuario.cEstado
        }
      }).then(response => {
        this.inicializarPaginacion();
        this.listUsuarios = response.data;
        this.fullscreenLoading = false;
      })
    },
    nextPage() {
      this.pageNumber++;

    },
    prevPage() {
      this.pageNumber--;
      
    },
    selectPage(page) {
      this.pageNumber = page;
    },
    inicializarPaginacion() {
      this.pageNumber = 0;
    },
    setCambiarEstadoUsuario(op, id){
      Swal.fire({
        title: '¿Está seguro de ' + ((op == 1) ? 'desactivar' : 'activar') + ' El usuario?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText:  ((op == 1) ? 'Si, desactivar' : 'Si, activar')
      }).then((result) => {
        if (result.isConfirmed) {
          this.fullscreenLoading = true;
          var url = '/administracion/usuario/setCambiarEstadoUsuario'
          axios.post(url, {
            'nIdUsuario' : id,
            'cEstado' : (op == 1) ? 'I' : 'A'
          }).then(response => {
            Swal.fire({
              icon: 'success',
              title: ((op == 1) ? 'desactivo' : 'activo') + ' el usuario',
              showConfirmButton: '',
              timer: 1500
            })
            this.getListUsuarios();
          })
        }
      })
    }
  }
}
</script>

<style>

</style>