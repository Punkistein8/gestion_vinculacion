<?php if ($this->session->userdata('usuario')->tipo_usu == 'DOCENTE') : ?>
  <?php if ($listadoEmpresas) : ?>
    <div>
      <h1 class="display-2 text-center py-10" style="margin: 40px 0;">Listado de Empresas</h1>

      <div class="table-responsive">
        <table id="tablaEmpresas" class="table table-hover table-md table-secondary table-striped table-bordered border-light">
          <thead class="thead-dark">
            <tr class="table-dark">
              <th scope="col">ID</th>
              <th scope="col">Nombre</th>
              <th scope="col">RUC</th>
              <th scope="col">Descripción</th>
              <th scope="col">Archivo Vinculación</th>
              <th scope="col">Asignar Estudiantes</th>
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
                <td id="celdaArchivo<?php echo $empresa->id_emp ?>">
                  <button class="btn btn-danger btn-sm disabled">
                    <i class="fa-solid fa-file-excel"></i></i> &nbsp; No hay archivos'
                  </button>
                </td>
                <td id="celdaEstudiante<?php echo $empresa->id_emp; ?>">

                </td>
                <td id="celdaAcciones<?php echo $empresa->id_emp ?>">
                  <button id="botonAgregarArchivo<?php echo $empresa->id_emp ?>" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalAgregarArchivo">
                    <i class="fa-solid fa-file-circle-plus"></i> &nbsp; Asignar archivos
                  </button>
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
        <strong>¡No hay empresas registrados!</strong> Solicita que se registren empresas para continuar.
      </div>
    </div>
  <?php endif; ?>

  <!-- Modal Nuevo Estudiante -->
  <div class="modal fade" id="modalAgregarArchivo" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
      <div class="modal-content bg-dark text-dark">
        <div class="modal-header">
          <h5 class="modal-title text-light" id="modalTitleId"><i class="fa-solid fa-file-circle-plus"></i> &nbsp; Asignar archivos a esta empresa </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formularioArchivosEmpresa" enctype="multipart/form-data" method="post">
          <div class="modal-body">
            <!-- Input de id docente -->
            <input type="hidden" name="fk_id_doc" id="fk_id_doc" value="">
            <!-- Input de id empresa -->
            <input type="hidden" name="fk_id_emp" id="fk_id_emp" value="">
            <!-- Input de texto -->
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="nombre_arv" name="nombre_arv" placeholder="Nombre del archivo">
              <label for="nombre_arv">Nombre del archivo</label>
            </div>
            <!-- input del archivo -->
            <div class="form-floating mb-3">
              <div style="display: flex;">
                <div>
                  <label for="documento_arv" style="color: whitesmoke;">Archivo</label>
                  <input type="file" accept="application/pdf" class="form-control" style="width: 100%; height: min-content;" id="documento_arv" name="documento_arv">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" id="botonGuardarArchivo" class="btn btn-primary">Guardar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Asignar Estudiante -->
  <div class="modal fade" id="modalAsignarEstudiante" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
      <div class="modal-content bg-dark text-dark">
        <div class="modal-header">
          <h5 class="modal-title text-light" id="modalTitleId"><i class="fa-solid fa-user-plus"></i> &nbsp; Asignar estudiante a esta empresa </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formularioAsignarEstudiante" enctype="multipart/form-data" method="post">
          <div class="modal-body">
            <!-- input hidden del id de archivo -->
            <input type="hidden" name="id_arv" id="id_arv" value="">
            <!-- select de estudiantes -->
            <div class="form-floating mb-3">
              <select class="form-select" id="fk_id_est" name="fk_id_est">
                <option value="">-- Seleccione un estudiante --</option>
                <?php foreach ($listadoEstudiantes as $estudiante) : ?>
                  <option value="<?php echo $estudiante->id_est ?>"><?php echo $estudiante->nombres_usu . ' ' . $estudiante->apellidos_usu . ' - ' . $estudiante->cedula_est ?></option>
                <?php endforeach; ?>
              </select>
              <label for="fk_id_est">Estudiante</label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" id="botonAsignarEstudiante" class="btn btn-primary">Asignar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Reasignar Estudiante -->
  <div class="modal fade" id="modalReasignarEstudiante" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
      <div class="modal-content bg-dark text-dark">
        <div class="modal-header">
          <h5 class="modal-title text-light" id="modalTitleId"><i class="fa-solid fa-user-plus"></i> &nbsp; Reasignar estudiante a esta empresa </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formularioReasignarEstudiante" enctype="multipart/form-data" method="post">
          <div class="modal-body">
            <!-- input hidden del id de archivo -->
            <input type="hidden" name="id_arv" id="id_arv" value="">
            <!-- select de estudiantes -->
            <div class="form-floating mb-3">
              <select class="form-select" id="fk_id_est" name="fk_id_est">
                <option value="">-- Seleccione un estudiante --</option>
                <?php foreach ($listadoEstudiantes as $estudiante) : ?>
                  <option value="<?php echo $estudiante->id_est ?>"><?php echo $estudiante->nombres_usu . ' ' . $estudiante->apellidos_usu . ' - ' . $estudiante->cedula_est ?></option>
                <?php endforeach; ?>
              </select>
              <label for="fk_id_est">Estudiante</label>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" id="botonAsignarEstudiante" class="btn btn-primary">Reasignar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- SCRIPT PARA AGREGAR EL ID DEL DOCENTE LOGEADO AL MODAL PARA SUBIR ARCHIVOS -->
  <?php if ($listadoEmpresas) : ?>
    <script>
      <?php foreach ($listadoEmpresas as $empresa) : ?>
        $('#botonAgregarArchivo<?php echo $empresa->id_emp ?>').click((e) => {
          $.ajax({
            type: "POST",
            url: "<?php echo site_url('docentes/getDocentePorIdUsuario/') . $this->session->userdata('usuario')->id_usu ?>",
            dataType: "json",
            success: function(response) {
              $('#modalAgregarArchivo').find('#fk_id_doc').val(response.docente[0].id_doc)
              $('#modalAgregarArchivo').find('#fk_id_emp').val(<?php echo $empresa->id_emp ?>)
            }
          })
        })
      <?php endforeach; ?>
    </script>
  <?php endif; ?>

  <!-- para que el modal se abra con el id del docente logeado y se llene el input del id de la empresa, EXTRAÑAMENTE NO FUNCIONA CON EL OTRO DECLARADO ARRIBA -->
  <script>
    function llenarModalJquery(id_emp) {
      $('#modalAgregarArchivo').find('#fk_id_emp').val(id_emp)
      $.ajax({
        type: "POST",
        url: "<?php echo site_url('docentes/getDocentePorIdUsuario/') . $this->session->userdata('usuario')->id_usu ?>",
        dataType: "json",
        success: function(response) {
          $('#modalAgregarArchivo').find('#fk_id_doc').val(response.docente[0].id_doc)
        }
      })
    }
  </script>

  <!-- SCRIPT PARA MOSTRAR LOS ARCHIVOS DE LA EMPRESA -->
  <?php if ($listadoEmpresas) : ?>
    <script>
      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Archivos_Vinculacion/getArchivosVinculacion') ?>",
        dataType: "json",
        success: function(response) {
          <?php foreach ($listadoEmpresas as $empresa) : ?>
            if (response) {
              botonARenderizarArchivo = response.filter(archivo => archivo.fk_id_emp == <?php echo $empresa->id_emp ?>).map(archivo => {
                return `
                  <a href="<?php echo base_url('assets/archivos_vinculacion/') ?>${archivo.documento_arv}" target="_blank">
                  <button class="btn btn-success btn-sm">
                  <i class="fa-solid fa-file-pdf"></i> &nbsp; Ver '${archivo.nombre_arv}'
                    </button>
                    </a>
                    `
              }).join('<br>');

              botonARenderizarAcciones = response.filter(archivo => archivo.fk_id_emp == <?php echo $empresa->id_emp ?>).map(archivo => {
                return `
                  <button class="btn btn-danger btn-sm" onclick="borrarArchivo(${archivo.id_arv})">
                  <i class="fa-solid fa-file-excel"></i> &nbsp; Eliminar Archivo
                    </button>
                    `
              }).join('<br>');

              botonRenderizarEstudiante = response.filter(archivo => archivo.fk_id_emp == <?php echo $empresa->id_emp ?>).map(archivo => {
                return archivo.fk_id_est;
              });

              if (!botonARenderizarArchivo && !botonARenderizarAcciones && botonRenderizarEstudiante[0] === undefined) {
                botonARenderizarArchivo = `
                <button class="btn btn-info btn-sm disabled">
                <i class="fa-solid fa-xmark"></i> &nbsp; No hay archivos'
                    </button>
                `
                botonARenderizarAcciones = `
                <button id="botonAgregarArchivoJquery<?php echo $empresa->id_emp ?>" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalAgregarArchivo" onclick="llenarModalJquery(<?php echo $empresa->id_emp ?>)">
                      <i class="fa-solid fa-file-circle-plus"></i> &nbsp; Asignar archivos
                    </button>
                `

                botonRenderizarEstudiante = `
                <button id="botonAgregarArchivoJquery<?php echo $empresa->id_emp ?>" class="btn btn-dark btn-sm disabled" data-bs-toggle="modal" data-bs-target="#modalAsignarEstudiante" onclick="llevarIdEmpresa(<?php echo $empresa->id_emp ?>)">
                <i class="fa-solid fa-user-slash"></i> &nbsp; Antes asigna un archivo
                    </button>
                `
              } else if (botonRenderizarEstudiante[0] === null) {
                botonRenderizarEstudiante = `
                <button id="botonAgregarArchivoJquery<?php echo $empresa->id_emp ?>" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#modalAsignarEstudiante" onclick="llevarIdEmpresa(<?php echo $empresa->id_emp ?>)">
                <i class="fa-solid fa-user-plus"></i> &nbsp; Asignar estudiante
                    </button>
                `
              } else {
                const fk_id_est = response.filter(archivo => archivo.fk_id_emp == <?php echo $empresa->id_emp ?>).map(archivo => {
                  return archivo.fk_id_est;
                });
                $.ajax({
                  type: 'post',
                  url: '<?php echo site_url('estudiantes/getEstudiantesUsuariosId/') ?>' + fk_id_est,
                  dataType: 'json',
                  success: (response) => {
                    const nombre = response.estudiante[0].nombres_usu;
                    const apellido = response.estudiante[0].apellidos_usu;
                    const cedula = response.estudiante[0].cedula_est;
                    if (response.status == 'success') {
                      botonRenderizarEstudiante = `
                      <button id="botonAgregarArchivoJquery<?php echo $empresa->id_emp ?>" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalReasignarEstudiante" onclick="llevarIdEmpresaReasignar(<?php echo $empresa->id_emp ?>)">
                      <i class="fa-solid fa-user-check"></i> &nbsp; Asignado a <b>${nombre + ' ' + apellido}</b>
                          </button>
                      `
                      $('#celdaEstudiante<?php echo $empresa->id_emp ?>').html(
                        botonRenderizarEstudiante
                      )
                    } else {
                      botonRenderizarEstudiante = `
                      <button id="botonAgregarArchivoJquery<?php echo $empresa->id_emp ?>" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalAsignarEstudiante" onclick="llenarModalJquery(<?php echo $empresa->id_emp ?>)">
                      <i class="fa-solid fa-user-check"></i> &nbsp; <b>NO SE PUDO OBTENER EL ESTUDIANTE</b>
                          </button>
                      `
                    }
                  }
                })

              }

              $('#celdaArchivo<?php echo $empresa->id_emp ?>').html(
                botonARenderizarArchivo
              )

              $('#celdaAcciones<?php echo $empresa->id_emp ?>').html(
                botonARenderizarAcciones
              )

              $('#celdaEstudiante<?php echo $empresa->id_emp ?>').html(
                botonRenderizarEstudiante
              )
            }
          <?php endforeach; ?>
        }
      })
    </script>
  <?php endif; ?>

  <!-- SCRIPT PARA SUBIR ARCHIVOS -->
  <script>
    $('#botonGuardarArchivo').click((e) => {
      $('#formularioArchivosEmpresa').validate({
        rules: {
          nombre_arv: {
            required: true,
            minlength: 3,
            maxlength: 50
          },
          documento_arv: {
            required: true,
            extension: "pdf"
          }
        },
        messages: {
          nombre_arv: {
            required: "El nombre del archivo es requerido",
            minlength: "El nombre del archivo debe tener al menos 3 caracteres",
            maxlength: "El nombre del archivo debe tener máximo 50 caracteres"
          },
          documento_arv: {
            required: "El archivo es requerido",
            extension: "El archivo debe ser un PDF"
          }
        },
        submitHandler: function(form) {
          // e.preventDefault();
          let formData = new FormData(form);
          $.ajax({
            type: "POST",
            url: "<?php echo site_url('archivos_vinculacion/insertArchivoVinculacionDocente') ?>",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            dataType: "json",
            success: function(response) {
              if (response.status == 'success') {
                Swal.fire({
                  icon: 'success',
                  title: '¡Éxito!',
                  text: response.message,
                  showConfirmButton: false,
                  timer: 3000,
                }).then(() => {
                  $('#modalAgregarArchivo').modal('hide');
                  $('#contenedorCambiable').load('<?php echo site_url('empresas/empresasDesdeDocentes') ?>');

                })
              } else {
                Swal.fire({
                  icon: 'error',
                  title: '¡Error!',
                  text: 'Ha ocurrido un error al guardar el archivo, por favor intente de nuevo.',
                  showConfirmButton: false,
                  timer: 5000,
                  timerProgressBar: true,
                  didOpen: () => {
                    Swal.showLoading()
                  },
                  willClose: () => {
                    clearInterval(timerInterval)
                  }
                }).then(() => {
                  window.location.href = "<?php echo site_url('docentes/empresas') ?>";
                })
              }
            }
          });
        }
      })
    })
  </script>

  <!-- SCRIPT PARA ELIMINAR ARCHIVOS -->
  <script>
    function borrarArchivo(id_emp) {
      Swal.fire({
        title: '¿Está seguro de eliminar este archivo?',
        text: "¡No podrá revertir los cambios!",
        'icon': 'warning',
        'showCancelButton': true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: '¡No, cancelar!',
        confirmButtonText: '¡Sí, eliminar!',
        'reverseButtons': true
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: "<?php echo site_url('Archivos_Vinculacion/borrarArchivoVinculacionDocente/') ?>" + id_emp,
            dataType: 'json',
            success: (response) => {
              if (response.status == 'success') {
                Swal.fire({
                  icon: 'success',
                  title: '¡Éxito!',
                  text: response.message,
                  showConfirmButton: false,
                  timer: 3000,
                }).then(() => {
                  $('#contenedorCambiable').load('<?php echo site_url('empresas/empresasDesdeDocentes') ?>');
                })
              } else {
                Swal.fire({
                  icon: 'error',
                  title: '¡Error!',
                  text: 'Ha ocurrido un error al eliminar el archivo, por favor intente de nuevo.',
                  showConfirmButton: false,
                  timer: 5000,
                  timerProgressBar: true,
                  didOpen: () => {
                    Swal.showLoading()
                  },
                  willClose: () => {
                    clearInterval(timerInterval)
                  }
                }).then(() => {
                  window.location.href = "<?php echo site_url('docentes/inicio') ?>";
                })
              }
            }
          })
        }
      })
    }
  </script>

  <!-- SCRIPT PARA ASIGNAR ESTUDIANTES -->
  <script>
    function llevarIdEmpresa(id_emp) {
      $.ajax({
        type: "POST",
        url: "<?php echo site_url('archivos_vinculacion/getArchivosVinculacionPorIdEmpresa/') ?>" + id_emp,
        dataType: 'json',
        success: (response) => {
          const id_arv = response.data[0].id_arv;
          $('#modalAsignarEstudiante').find('#id_arv').val(id_arv);
        }
      })
      $('#formularioAsignarEstudiante').validate({
        rules: {
          fk_id_est: {
            required: true
          }
        },
        messages: {
          fk_id_est: {
            required: "Seleccione un estudiante para asignar"
          }
        },
        submitHandler: function(form) {
          // e.preventDefault();
          let formData = new FormData(form);
          $.ajax({
            type: "POST",
            url: "<?php echo site_url('archivos_vinculacion/asignarEstudianteEmpresa') ?>",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            dataType: "json",
            success: function(response) {
              if (response.status == 'success') {
                Swal.fire({
                  icon: 'success',
                  title: '¡Éxito!',
                  text: response.message,
                  showConfirmButton: false,
                  timer: 3000,
                }).then(() => {
                  $('#modalAsignarEstudiante').modal('hide');
                  $('#contenedorCambiable').load('<?php echo site_url('empresas/empresasDesdeDocentes') ?>');

                })
              } else {
                Swal.fire({
                  icon: 'error',
                  title: '¡Error!',
                  text: 'Ha ocurrido un error al asignar el estudiante, por favor intente de nuevo.',
                  showConfirmButton: false,
                  timer: 5000,
                  timerProgressBar: true,
                  didOpen: () => {
                    Swal.showLoading()
                  },
                  willClose: () => {
                    clearInterval(timerInterval)
                  }
                }).then(() => {
                  window.location.href = "<?php echo site_url('docentes/empresas') ?>";
                })
              }
            }
          });
        }
      })
    }
  </script>

  <!-- SCRIPT PARA REASIGNAR ESTUDIANTES -->
  <script>
    function llevarIdEmpresaReasignar(id_emp) {
      $.ajax({
        type: "POST",
        url: "<?php echo site_url('archivos_vinculacion/getArchivosVinculacionPorIdEmpresa/') ?>" + id_emp,
        dataType: 'json',
        success: (response) => {
          const id_arv = response.data[0].id_arv;
          $('#modalReasignarEstudiante').find('#id_arv').val(id_arv);
        }
      })
      $('#formularioReasignarEstudiante').validate({
        rules: {
          fk_id_est: {
            required: true
          }
        },
        messages: {
          fk_id_est: {
            required: "Seleccione un estudiante para asignar"
          }
        },
        submitHandler: function(form) {
          let formData = new FormData(form);
          $.ajax({
            type: "POST",
            url: "<?php echo site_url('archivos_vinculacion/asignarEstudianteEmpresa') ?>",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            dataType: "json",
            success: function(response) {
              if (response.status == 'success') {
                Swal.fire({
                  icon: 'success',
                  title: '¡Éxito!',
                  text: response.message,
                  showConfirmButton: false,
                  timer: 3000,
                }).then(() => {
                  $('#modalReasignarEstudiante').modal('hide');
                  $('#contenedorCambiable').load('<?php echo site_url('empresas/empresasDesdeDocentes') ?>');

                })
              } else {
                Swal.fire({
                  icon: 'error',
                  title: '¡Error!',
                  text: 'Ha ocurrido un error al asignar el estudiante, por favor intente de nuevo.',
                  showConfirmButton: false,
                  timer: 5000,
                  timerProgressBar: true,
                  didOpen: () => {
                    Swal.showLoading()
                  },
                  willClose: () => {
                    clearInterval(timerInterval)
                  }
                }).then(() => {
                  window.location.href = "<?php echo site_url('docentes/empresas') ?>";
                })
              }
            }
          });
        }
      })
    }
  </script>

  <!-- SCRIPT BOOTSTRAP SELECT -->
  <script>
    $(function() {
      $('.selectpicker').selectpicker({
        style: 'form-select',
        size: 4
      });
    });
  </script>

<?php else : ?>
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
      window.location.href = "<?php echo site_url('logins') ?>";
    })
  </script>
<?php endif; ?>

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