<?php if ($this->session->userdata('usuario')->tipo_usu == 'ADMIN') : ?>
  <?php if ($listadoEmpresas) : ?>
    <div>
      <h1 class="display-2 text-center py-10" style="margin: 40px 0;">Listado de Empresas</h1>

      <div class="d-grid gap-2" style="margin: 20px 0;">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalId"> <i class="fa-sharp fa-solid fa-user-plus"></i> &nbsp; Nueva Empresa</button>
      </div>

      <div class="table-responsive">
        <table id="tablaEmpresas" class="table table-hover table-md table-secondary table-striped table-bordered border-light">
          <thead class="thead-dark">
            <tr class="table-dark">
              <th scope="col">ID</th>
              <th scope="col">Nombre</th>
              <th scope="col">RUC</th>
              <th scope="col">Descripción</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($listadoEmpresas as $empresa) : ?>
              <tr>
                <td><?php echo $empresa->id_emp ?></td>
                <td><?php echo $empresa->nombre_emp ?></td>
                <td><?php echo $empresa->ruc_emp ?></td>
                <td><?php echo $empresa->descripcion_emp ?></td>
                <td>
                  <button id="botonEditarEmpresa<?php echo $empresa->id_emp ?>" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditarEmpresa">Editar</button>
                  <button type="button" class="btn btn-danger btn-sm" id="botonEliminarEmpresa<?php echo $empresa->id_emp ?>">Eliminar</button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  <?php else : ?>
    <div style="height: 100vh; display: flex; justify-content: center; align-items: flex-start; padding-top: 150px;">
      <div class="alert alert-info alert-dismissible fade show" style="display: flex; justify-content: space-between; gap: 30px;" role="alert">
        <strong>¡No hay empresas registrados!</strong> Registra empresas para continuar.
        <button type="button" class="btn btn-primary btn-sm float-right" data-bs-toggle="modal" data-bs-target="#modalId">Registrar empresa</button>
      </div>
    </div>
  <?php endif; ?>

  <!-- Modal Nuevo Empresa -->
  <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
      <div class="modal-content bg-dark text-dark">
        <div class="modal-header">
          <h5 class="modal-title text-light" id="modalTitleId"><i class="fa-solid fa-square-plus"></i> &nbsp; Registrar nueva empresa </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formularioEmpresas" enctype="multipart/form-data" method="post">
          <div class="modal-body">
            <!-- input nombre del empresa -->
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="nombre_emp" name="nombre_emp" placeholder="Nombre">
              <label for="nombre_emp">Nombre</label>
            </div>
            <!-- input apellidos del empresa -->
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="ruc_emp" name="ruc_emp" placeholder="RUC">
              <label for="ruc_emp">RUC</label>
            </div>
            <!-- textarea descripcion -->
            <div class="form-floating mb-3">
              <div style="display: flex; flex-direction: column;">
                <label style="color: whitesmoke;">Descripción</label>
                <textarea name="descripcion_emp" id="descripcion_emp" style="width: 100%;" rows="5"></textarea>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" id="botonGuardarEmpresa" class="btn btn-primary">Guardar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Editar Empresa -->
  <div class="modal fade" id="modalEditarEmpresa" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
      <div class="modal-content bg-dark text-dark">
        <div class="modal-header">
          <h5 class="modal-title text-light" id="modalTitleId"><i class="fa-sharp fa-solid fa-user-pen"></i> &nbsp; Editar empresa </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formularioEditarEmpresa" enctype="multipart/form-data" method="post">
          <div class="modal-body">
            <!-- input int id_emp hidden -->
            <input type="hidden" id="id_emp" name="id_emp">
            <!-- input nombre del empresa -->
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="nombre_emp" name="nombre_emp" placeholder="Nombre">
              <label for="nombre_emp">Nombre</label>
            </div>
            <!-- input apellidos del empresa -->
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="ruc_emp" name="ruc_emp" placeholder="RUC">
              <label for="ruc_emp">RUC</label>
            </div>
            <!-- textarea descripcion -->
            <div class="form-floating mb-3">
              <div style="display: flex; flex-direction: column;">
                <label style="color: whitesmoke;">Descripción</label>
                <textarea name="descripcion_emp" id="descripcion_emp" style="width: 100%;" rows="5"></textarea>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" id="botonActualizarEmpresa" class="btn btn-primary">Guardar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Insertar empresas -->
  <script>
    $('#botonGuardarEmpresa').click(function(e) {
      $('#formularioEmpresas').validate({
        rules: {
          nombre_emp: {
            required: true,
            minlength: 3,
            maxlength: 50
          },
          ruc_emp: {
            required: true,
            minlength: 11,
            maxlength: 13
          },
          descripcion_emp: {
            required: true,
            minlength: 3,
            maxlength: 50
          },
        },
        messages: {
          nombre_emp: {
            required: 'El campo nombre es obligatorio',
            minlength: 'El campo nombre debe tener al menos 3 caracteres',
            maxlength: 'El campo nombre debe tener como máximo 50 caracteres'
          },
          ruc_emp: {
            required: 'El campo RUC es obligatorio',
            minlength: 'El campo RUC debe tener al menos 11 caracteres',
            maxlength: 'El campo RUC debe tener como máximo 13 caracteres'
          },
          descripcion_emp: {
            required: 'El campo descripción es obligatorio',
            minlength: 'El campo descripción debe tener al menos 3 caracteres',
            maxlength: 'El campo descripción debe tener como máximo 50 caracteres'
          },
        },
        submitHandler: function(form) {
          var formData = new FormData(form);
          $.ajax({
            url: '<?php echo site_url('empresas/insertEmpresa') ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            cache: false, // esto es para que no se guarde en cache la foto del usuario al servidor y se pueda actualizar la foto del usuario en el servidor sin problemas
            contentType: false, // esto es para que no se procese el data como un string sino como un objeto de tipo file para poder subir la foto del usuario al servidor
            processData: false,
            success: function(response) {
              if (response.status == 'success') {
                Swal.fire({
                  icon: 'success',
                  title: '¡Empresa registrada!',
                  text: response.message,
                  showConfirmButton: false,
                  timer: 1500
                })
                $('#modalId').modal('hide');
                $('#formularioEmpresas')[0].reset();
                $('#contenedorCambiable').load('<?php echo site_url('empresas') ?>');
              } else {
                Swal.fire({
                  icon: 'error',
                  title: '¡Error!',
                  text: response.message + response,
                  showConfirmButton: false,
                  timer: 1500
                })
              }
            }
          })
        }
      })
    })
  </script>

  <!-- llenar inputs de modal actualizar -->
  <?php if ($listadoEmpresas) : ?>
    <?php foreach ($listadoEmpresas as $empresa) : ?>
      <script>
        $('#botonEditarEmpresa<?php echo $empresa->id_emp ?>').click((e) => {
          $.ajax({
            type: 'POST',
            url: '<?php echo site_url('empresas/getEmpresa/') . $empresa->id_emp ?>',
            dataType: 'json',
            success: (response) => {
              console.log(response);
              if (response.status == 'success') {
                $('#formularioEditarEmpresa').find('#nombre_emp').val(response.empresa[0].nombre_emp);
                $('#formularioEditarEmpresa').find('#ruc_emp').val(response.empresa[0].ruc_emp);
                $('#formularioEditarEmpresa').find('#descripcion_emp').val(response.empresa[0].descripcion_emp);
                $('#formularioEditarEmpresa').find('#id_emp').val(response.empresa[0].id_emp);
              } else {
                Swal.fire({
                  icon: 'error',
                  title: '¡Error!',
                  text: response.message,
                  showConfirmButton: false,
                  timer: 1500
                })
              }
            }
          })

          $('#botonActualizarEmpresa').click(function(e) {
            $('#formularioEditarEmpresa').validate({
              rules: {
                nombre_emp: {
                  required: true,
                  minlength: 3,
                  maxlength: 50
                },
                ruc_emp: {
                  required: true,
                  minlength: 11,
                  maxlength: 13
                },
                descripcion_emp: {
                  required: true,
                  minlength: 3,
                  maxlength: 50
                },
              },
              messages: {
                nombre_emp: {
                  required: 'El campo nombre es obligatorio',
                  minlength: 'El campo nombre debe tener al menos 3 caracteres',
                  maxlength: 'El campo nombre debe tener como máximo 50 caracteres'
                },
                ruc_emp: {
                  required: 'El campo RUC es obligatorio',
                  minlength: 'El campo RUC debe tener al menos 11 caracteres',
                  maxlength: 'El campo RUC debe tener como máximo 13 caracteres'
                },
                descripcion_emp: {
                  required: 'El campo descripción es obligatorio',
                  minlength: 'El campo descripción debe tener al menos 3 caracteres',
                  maxlength: 'El campo descripción debe tener como máximo 50 caracteres'
                },
              },
              submitHandler: function(form) {
                var formData = new FormData(form);
                $.ajax({
                  url: '<?php echo site_url('empresas/updateEmpresa') ?>',
                  type: 'POST',
                  data: formData,
                  dataType: 'json',
                  cache: false, // esto es para que no se guarde en cache la foto del usuario al servidor y se pueda actualizar la foto del usuario en el servidor sin problemas
                  contentType: false, // esto es para que no se procese el data como un string sino como un objeto de tipo file para poder subir la foto del usuario al servidor
                  processData: false,
                  success: function(response) {
                    console.log(response);
                    if (response.status == 'success') {
                      Swal.fire({
                        icon: 'success',
                        title: '¡Empresa actualizada!',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500
                      })
                      $('#modalEditarEmpresa').modal('hide');
                      $('#formularioEditarEmpresa')[0].reset();
                      $('#contenedorCambiable').load('<?php echo site_url('empresas') ?>');
                    } else {
                      Swal.fire({
                        icon: 'error',
                        title: '¡Error!',
                        text: response.message + response,
                        showConfirmButton: false,
                        timer: 1500
                      })
                    }

                  }
                })
              }
            })
          })
        })
      </script>
    <?php endforeach; ?>
  <?php endif; ?>

  <!-- Actualizar empresa -->
  <script>
  </script>

  <!-- eliminar empresa -->
  <script>
    <?php if ($listadoEmpresas) : ?>
      <?php foreach ($listadoEmpresas as $empresa) : ?>
        $('#botonEliminarEmpresa<?php echo $empresa->id_emp ?>').click((e) => {
          Swal.fire({
            title: '¿Está seguro de eliminar el empresa?',
            text: "¡No podrá revertir los cambios!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, eliminar!',
            cancelButtonText: '¡No, cancelar!'
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: '<?php echo site_url('empresas/deleteEmpresa/') . $empresa->id_emp; ?>',
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                  if (response.status == 'success') {
                    Swal.fire({
                      icon: 'success',
                      title: '¡Empresa eliminado!',
                      text: response.message,
                      showConfirmButton: false,
                      timer: 1500
                    })
                    $('#contenedorCambiable').load('<?php echo site_url('empresas') ?>');
                  } else {
                    Swal.fire({
                      icon: 'error',
                      title: '¡Error!',
                      text: response.message,
                      showConfirmButton: false,
                      timer: 1500
                    })
                  }
                }
              })
            }
          })
        })
      <?php endforeach; ?>
    <?php endif; ?>
  </script>

  <style>
    .form-floating>label {
      left: auto !important;
    }

    .error {
      color: red;
      right: 0 !important;
    }

    select {
      color: black !important;
    }
  </style>
<?php else : ?>
  <!-- alerta de que no tiene permiso para ver esto con timer de redireccionamiento a una pagina hacia atras-->
  <script>
    Swal.fire({
      icon: 'error',
      title: '¡Error!',
      text: 'No tienes permisos para ver esta página, serás redireccionado en breve.',
      showConfirmButton: false,
      timer: 5000,
      timerProgressBar: true,
      didOpen: () => {
        Swal.showLoading()
      },
      
    }).then(() => {
      window.history.back();
    })
  </script>

<?php endif; ?>