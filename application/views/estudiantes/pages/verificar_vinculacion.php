<?php if ($this->session->userdata('usuario')->tipo_usu == 'ESTUDIANTE') : ?>

  <?php if ($listadoArchivosVinculacion) : ?>
    <div class="container">
      <h1 class="display-4 text-center pt-5 mt-2">Tu empresa de vinculación</h1>
      <section class="mx-auto my-5" style="max-width: 23rem;">
        <div class="card">
          <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
            <img src="https://cdn.pixabay.com/photo/2020/04/01/12/46/city-4991094_960_720.jpg" class="img-fluid" />
            <a href="#!">
              <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
            </a>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <h5 class="card-title font-weight-bold fw-bold"> <i class="fa-solid fa-building"></i> <a id="nombre_emp">Nombre de la empresa</a></h5>
                <p class="card-text" id="descripcion_emp">
                  Descripcion de la empresa
                </p>
              </div>
              <!-- Boton para verificar archivos de vinculacion -->
              <div class="col-md-4 pt-2">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalArchivosVinculacion" onclick="modalClick()">
                  <i class=" fa-sharp fa-solid fa-file-pdf"></i>
                  <small>Verificar</small>
                </button>
              </div>
            </div>
            <hr class="my-4" />
            <!-- Circulo para foto -->
            <div class="avatar avatar-xl" style="display: flex;">
              <p class="lead"> <strong id="nombre_usu" class="fw-bold">Nombre del docente</strong></p>
              &nbsp;
              <img id="foto_usu" class="rounded-circle" alt="Foto del docente" width="40px" height="40px" />
            </div>

            <small style="position: absolute; transform: translateY(-20px);">
              <i class="fa-solid fa-user-tie"></i>
              <small id="titulo_doc">Titulo del docente</small>
            </small>

          </div>
        </div>
      </section>
    </div>



    <!-- Modal Subir Archivo -->
    <div class="modal fade" id="modalArchivosVinculacion" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content bg-dark text-dark">
          <div class="modal-header">
            <h5 class="modal-title text-light" id="modalTitleId"><i class="fa-solid fa-file-pen"></i> &nbsp; Verificar archivo de vinculación </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="formularioArchivosEmpresa" enctype="multipart/form-data" method="post">
            <div class="modal-body">
              <!-- Input de id archivo -->
              <input type="hidden" name="id_arv" id="id_arv" value="">
              <!-- Input de id docente -->
              <input type="hidden" name="fk_id_doc" id="fk_id_doc" value="">
              <!-- Input de id empresa -->
              <input type="hidden" name="fk_id_emp" id="fk_id_emp" value="">
              <!-- Input de texto solo de lectura -->
              <div class="form-floating mb-3">
                <input type="text" readonly class="form-control" id="nombre_arv_readonly" name="nombre_arv_readonly" placeholder="Nombre del archivo">
                <label for="nombre_arv_readonly">Nombre del archivo en la base de datos</label>
              </div>
              <!-- boton para poder descargar el archivo -->
              <div class="form-floating mb-3 d-grid gap-2">
                <a href="<?php echo base_url('assets/archivos_vinculacion/' . $listadoArchivosVinculacion[0]->documento_arv); ?>" class="btn btn-primary" download="<?php echo $listadoArchivosVinculacion[0]->documento_arv; ?>">
                  <i class="fa-solid fa-file-download"></i>
                  Descargar archivo
                </a>
              </div>

              &nbsp;
              <hr style="color: white; margin: 10px 0;">
              <!-- aviso de instrucciones -->
              <div class="alert alert-warning" role="alert">
                <i class="fa-solid fa-exclamation-triangle"></i>
                <small>Si desea subir un nuevo archivo, por favor, escriba el nombre del nuevo archivo y súbalo en el campo de abajo.</small>
              </div>
              <hr style="color: white; margin: 10px 0;">
              &nbsp;

              <!-- Input de texto  -->
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nombre_arv" name="nombre_arv" placeholder="Nombre del archivo">
                <label for="nombre_arv">Nombre del archivo a subir</label>
              </div>
              <!-- input del archivo nuevo a subir -->
              <div class="form-floating mb-3">
                <div style="display: flex;">
                  <div>
                    <label for="documento_arv" style="color: whitesmoke;"><small>Suba aquí el nuevo archivo</small></label>
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
              url: "<?php echo site_url('archivos_vinculacion/updateArchivoVinculacionDocente') ?>",
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
                    $('#modalArchivosVinculacion').modal('hide');
                    $.ajax({
                      url: '<?php echo site_url('estudiantes/getUsuariosEstudiantesId/') . $this->session->userdata('usuario')->id_usu; ?>',
                      dataType: 'json',
                      success: function(data) {
                        if (data.status == 'success') {
                          var id_est = data.estudiante[0].id_est;
                          $('#contenedorCambiable').load('<?php echo site_url('estudiantes/verificarVinculacion/') ?>' + id_est);
                        } else {
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
                        }
                      }
                    })
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

    <!-- SCRIPT PARA LLENAR LOS CAMPOS AL CARGAR EL MODAL -->
    <script>
      function modalClick() {
        const data = <?php echo json_encode($listadoArchivosVinculacion); ?>[0];
        $('#id_arv').val(data.id_arv);
        $('#fk_id_doc').val(data.fk_id_doc);
        $('#fk_id_emp').val(data.fk_id_emp);
        $('#nombre_arv_readonly').val(data.nombre_arv);
      }
    </script>

    <script>
      // cuando cargue el documento jquery
      $(document).ready(() => {
        console.log(<?php echo json_encode($listadoArchivosVinculacion); ?>[0]);
        const data = <?php echo json_encode($listadoArchivosVinculacion); ?>[0];
        $('#nombre_emp').text(data.nombre_emp);
        $('#descripcion_emp').text(data.descripcion_emp);
        $('#nombre_usu').text(data.nombres_usu + ' ' + data.apellidos_usu);
        $('#titulo_doc').text(data.titulo_doc);
        $('#foto_usu').attr('src', '<?php echo base_url('assets/fotos_usuarios/docentes/') ?>' + data.foto_usu);
      })
    </script>
  <?php else : ?>
    <div class="container text-center" style="margin-top: 40vh;">
      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-info  fade show" role="alert">
            <strong>¡Aún no te han asignado a una empresa!</strong> <br>
            <p>Para poder subir tu archivo de vinculación, tu docente debe asignarte a una empresa.</p>
            <hr>
            <p>Si crees que se trata de un error, comunícate con tu docente.</p>
            </p>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

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