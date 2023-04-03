<?php if ($this->session->userdata('usuario')->tipo_usu == 'ADMIN') : ?>
  <?php if ($listadoDocentes) : ?>
    <div>
      <h1 class="display-2 text-center py-10" style="margin: 40px 0;">Listado de Docentes</h1>

      <div class="d-grid gap-2" style="margin: 20px 0;">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalId"> <i class="fa-sharp fa-solid fa-user-plus"></i> &nbsp; Nuevo Docente</button>
      </div>

      <div class="table-responsive">
        <table id="tablaDocentes" class="table table-hover table-md table-secondary table-striped table-bordered border-light">
          <thead class="thead-dark">
            <tr class="table-dark">
              <th scope="col">ID</th>
              <th scope="col">Nombres</th>
              <th scope="col">Apellidos</th>
              <th scope="col">Cédula</th>
              <th scope="col">Título</th>
              <th scope="col">Email</th>
              <th scope="col">Foto</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($listadoDocentes as $docente) : ?>
              <tr>
                <td><?php echo $docente->id_doc ?></td>
                <td><?php echo $docente->nombres_usu ?></td>
                <td><?php echo $docente->apellidos_usu ?></td>
                <td><?php echo $docente->cedula_doc ?></td>
                <td><?php echo $docente->titulo_doc ?></td>
                <td><?php echo $docente->email_usu ?></td>
                <td>
                  <?php if ($docente->foto_usu) : ?>
                    <a target="_blank" href="<?php echo base_url("assets/fotos_usuarios/docentes/" . $docente->foto_usu); ?>" data-lightbox="image-1" data-title="<?php echo $docente->foto_usu; ?>">
                      <img src="<?php echo base_url("assets/fotos_usuarios/docentes/" . $docente->foto_usu); ?>" alt="foto de docente" width="50px" height="50px">
                    </a>
                  <?php else : ?>
                    <img src="<?php echo base_url("assets/fotos_usuarios/sin_imagen.png"); ?>" alt="sin foto de docente" width="50px" height="50px">
                  <?php endif; ?>
                </td>
                <td>
                  <button id="botonEditarDocente<?php echo $docente->id_doc ?>" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditarDocente">Editar</button>
                  <button type="button" class="btn btn-danger btn-sm" id="eliminarDocente<?php echo $docente->id_doc ?>">Eliminar</button>
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
        <strong>¡No hay docentes registrados!</strong> Registra docentes para continuar.
        <button type="button" class="btn btn-primary btn-sm float-right" data-bs-toggle="modal" data-bs-target="#modalId">Registrar docente</button>
      </div>
    </div>
  <?php endif; ?>

  <!-- Modal Nuevo Docente -->
  <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
      <div class="modal-content bg-dark text-dark">
        <div class="modal-header">
          <h5 class="modal-title text-light" id="modalTitleId"><i class="fa-sharp fa-solid fa-user-plus"></i> &nbsp; Registrar nuevo docente </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formularioDocentes" enctype="multipart/form-data" method="post">
          <div class="modal-body">
            <!-- input nombre del docente -->
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="nombres_usu" name="nombres_usu" placeholder="Nombre">
              <label for="nombres_usu">Nombres</label>
            </div>
            <!-- input apellidos del docente -->
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="apellidos_usu" name="apellidos_usu" placeholder="Apellidos">
              <label for="apellidos_usu">Apellidos</label>
            </div>
            <!-- input cedula del docente -->
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="cedula_doc" name="cedula_doc" placeholder="Cedula">
              <label for="cedula_doc">Cédula</label>
            </div>
            <!-- input select título profestional del docente -->
            <div class="form-floating mb-3">
              <select class="form-select" id="titulo_doc" name="titulo_doc">
                <option selected value="">Seleccione el título profesional</option>
                <option value="Licenciado">Licenciado</option>
                <option value="Ingeniero">Ingeniero</option>
                <option value="Doctor">Doctor</option>
              </select>
              <label for="titulo_doc">Título profesional</label>
            </div>

            <!-- input correo del docente -->
            <div class="form-floating mb-3">
              <input type="email" class="form-control" id="email_usu" name="email_usu" placeholder="Correo">
              <label for="email_usu">Correo</label>
            </div>
            <!-- input de la password -->
            <div class="form-floating mb-3">
              <input type="password" class="form-control" id="pass_usu" name="pass_usu" placeholder="Contraseña">
              <label for="pass_usu">Contraseña</label>
            </div>
            <!-- input de la foto -->
            <div class="form-floating mb-3">
              <div style="display: flex;">
                <div>
                  <label for="foto_usu" style="color: whitesmoke;">Foto</label>
                  <input type="file" accept="image/png, image/jpeg" class="form-control" style="width: 90%; height: min-content;" id="foto_usu" name="foto_usu" placeholder="Foto" onchange="mostrarImagen(this);">
                </div>
                <img id="mostrar_foto" alt="Aquí se mostrará la foto que elija" width="150px" height="100px" class="img-thumbnail">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" id="botonGuardarDocente" class="btn btn-primary">Guardar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Editar Docente -->
  <div class="modal fade" id="modalEditarDocente" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
      <div class="modal-content bg-dark text-dark">
        <div class="modal-header">
          <h5 class="modal-title text-light" id="modalTitleId"><i class="fa-sharp fa-solid fa-user-pen"></i> &nbsp; Editar docente </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formularioEditarDocente" enctype="multipart/form-data" method="post">
          <div class="modal-body">
            <!-- input nombre del docente -->
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="nombres_usu" name="nombres_usu" placeholder="Nombre">
              <label for="nombres_usu">Nombres</label>
            </div>
            <!-- id docente hidden -->
            <input id="id_doc" name="id_doc">
            <!-- fk_id_usu hidden -->
            <input id="fk_id_usu" name="fk_id_usu">
            <!-- input apellidos del docente -->
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="apellidos_usu" name="apellidos_usu" placeholder="Apellidos">
              <label for="apellidos_usu">Apellidos</label>
            </div>
            <!-- input cedula del docente -->
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="cedula_doc" name="cedula_doc" placeholder="Cedula">
              <label for="cedula_doc">Cédula</label>
            </div>
            <!-- input select título profestional del docente -->
            <div class="form-floating mb-3">
              <select class="form-select" id="titulo_doc" name="titulo_doc">
                <option selected value="">Seleccione el título profesional</option>
                <option value="Licenciado">Licenciado</option>
                <option value="Ingeniero">Ingeniero</option>
                <option value="Doctor">Doctor</option>
              </select>
              <label for="titulo_doc">Título profesional</label>
            </div>

            <!-- input correo del docente -->
            <div class="form-floating mb-3">
              <input type="email" class="form-control" id="email_usu" name="email_usu" placeholder="Correo">
              <label for="email_usu">Correo</label>
            </div>
            <!-- input de la password -->
            <div class="form-floating mb-3">
              <input type="password" class="form-control" id="pass_usu" name="pass_usu" placeholder="Contraseña">
              <label for="pass_usu">Contraseña</label>
            </div>
            <!-- input de la foto -->
            <div class="form-floating mb-3">
              <div style="display: flex;">
                <div>
                  <label for="foto_usu" style="color: whitesmoke;">Foto</label>
                  <input type="file" accept="image/png, image/jpeg" class="form-control" style="width: 90%; height: min-content;" id="foto_usu" name="foto_usu" placeholder="Foto" onchange="mostrarImagen(this);">
                </div>
                <img id="mostrar_foto_editar" alt="Aquí se mostrará la foto que elija" width="150px" height="100px" class="img-thumbnail">
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" id="botonActualizarDocente" class="btn btn-primary">Guardar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Insertar docentes -->
  <script>
    $('#botonGuardarDocente').click(function(e) {
      $('#formularioDocentes').validate({
        rules: {
          nombres_usu: {
            required: true,
            minlength: 3
          },
          apellidos_usu: {
            required: true,
            minlength: 3
          },
          cedula_doc: {
            required: true,
            minlength: 10,
            maxlength: 13
          },
          titulo_doc: {
            required: true
          },
          email_usu: {
            required: true,
            email: true
          },
          pass_usu: {
            required: true,
            minlength: 4
          },
        },
        messages: {
          nombres_usu: {
            required: 'El campo es requerido',
            minlength: 'El campo debe t ener al menos 3 caracteres'
          },
          apellidos_usu: {
            required: 'El campo es requerido',
            minlength: 'El campo debe tener al menos 3 caracteres'
          },
          cedula_doc: {
            required: 'El campo es requerido',
            minlength: 'El campo debe tener al menos 10 caracteres',
            maxlength: 'El campo debe tener máximo 13 caracteres'
          },
          titulo_doc: {
            required: 'Seleccione un título profesional'
          },
          email_usu: {
            required: 'El campo es requerido',
            email: 'El campo debe ser un correo válido'
          },
          pass_usu: {
            required: 'El campo es requerido',
            minlength: 'El campo debe tener al menos 4 caracteres'
          },

        },
        submitHandler: function(form) {
          var formData = new FormData(form);
          $.ajax({
            url: '<?php echo site_url('docentes/insertDocente') ?>',
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
                  title: '¡Docente registrado!',
                  text: response.message,
                  showConfirmButton: false,
                  timer: 1500
                })
                $('#modalId').modal('hide');
                $('#formularioDocentes')[0].reset();
                $('#contenedorCambiable').load('<?php echo site_url('docentes') ?>');
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
  <script>
    <?php if ($listadoDocentes) : ?>
      <?php foreach ($listadoDocentes as $docente) : ?>
        $('#botonEditarDocente<?php echo $docente->id_doc ?>').click(() => {
          $.ajax({
            type: 'POST',
            url: '<?php echo site_url('docentes/getDocentesUsuariosId/') . $docente->id_doc ?>',
            dataType: 'json',
            success: (response) => {
              if (response.status == 'success') {
                $('#formularioEditarDocente').find('#nombres_usu').val(response.docente[0].nombres_usu);
                $('#formularioEditarDocente').find('#apellidos_usu').val(response.docente[0].apellidos_usu);
                $('#formularioEditarDocente').find('#cedula_doc').val(response.docente[0].cedula_doc);
                $('#formularioEditarDocente').find('#titulo_doc').val(response.docente[0].titulo_doc);
                $('#formularioEditarDocente').find('#email_usu').val(response.docente[0].email_usu);
                $('#formularioEditarDocente').find('#pass_usu').val(response.docente[0].pass_usu);
                $('#formularioEditarDocente').find('#id_doc').val(response.docente[0].id_doc);
                $('#formularioEditarDocente').find('#fk_id_usu').val(response.docente[0].fk_id_usu);
                $('#formularioEditarDocente').find('#mostrar_foto_editar').attr('src', '<?php echo base_url('assets/fotos_usuarios/docentes/') ?>' + response.docente[0].foto_usu);
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

          $('#botonActualizarDocente').click(function(e) {
            $('#formularioEditarDocente').validate({
              rules: {
                nombres_usu: {
                  required: true,
                  minlength: 3
                },
                apellidos_usu: {
                  required: true,
                  minlength: 3
                },
                cedula_doc: {
                  required: true,
                  minlength: 10,
                  maxlength: 13
                },
                titulo_doc: {
                  required: true
                },
                email_usu: {
                  required: true,
                  email: true
                },
                pass_usu: {
                  required: true,
                  minlength: 4
                },
              },
              messages: {
                nombres_usu: {
                  required: 'El campo es requerido',
                  minlength: 'El campo debe tener al menos 3 caracteres'
                },
                apellidos_usu: {
                  required: 'El campo es requerido',
                  minlength: 'El campo debe tener al menos 3 caracteres'
                },
                cedula_doc: {
                  required: 'El campo es requerido',
                  minlength: 'El campo debe tener al menos 10 caracteres',
                  maxlength: 'El campo debe tener máximo 13 caracteres'
                },
                titulo_doc: {
                  required: 'Seleccione un título profesional'
                },
                email_usu: {
                  required: 'El campo es requerido',
                  email: 'El campo debe ser un correo válido'
                },
                pass_usu: {
                  required: 'El campo es requerido',
                  minlength: 'El campo debe tener al menos 4 caracteres'
                },
              },
              submitHandler: function(form) {
                var formData = new FormData(form);
                $.ajax({
                  url: '<?php echo site_url('docentes/updateDocente') ?>',
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
                        title: '¡Docente actualizado!',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500
                      })
                      $('#modalEditarDocente').modal('hide');
                      $('#formularioEditarDocente')[0].reset();
                      $('#contenedorCambiable').load('<?php echo site_url('docentes') ?>');
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

      <?php endforeach; ?>
    <?php endif; ?>
  </script>

  <!-- Actualizar docente -->
  <script>

  </script>

  <!-- eliminar docente -->
  <script>
    <?php if ($listadoDocentes) : ?>
      <?php foreach ($listadoDocentes as $docente) : ?>
        $('#eliminarDocente<?php echo $docente->id_doc ?>').click(() => {
          Swal.fire({
            title: '¿Está seguro de eliminar el docente?',
            text: "¡No podrá revertir los cambios!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, eliminar!',
            cancelButtonText: '¡No, cancelar!'
          }).then((result) => {
            if (result.isConfirmed) {
              console.log(result);
              $.ajax({
                url: '<?php echo site_url('docentes/deleteDocente/') . $docente->id_doc; ?>',
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                  console.log(response);
                  if (response.status == 'success') {
                    Swal.fire({
                      icon: 'success',
                      title: '¡Docente eliminado!',
                      text: response.message,
                      showConfirmButton: false,
                      timer: 1500
                    })
                    $('#contenedorCambiable').load('<?php echo site_url('docentes') ?>');
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
  <!-- alerta de que no tiene permiso para ver esto con timer de redireccionamiento a logins-->
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
      window.location.href = '<?php echo site_url('logins') ?>';
    })
  </script>

<?php endif; ?>