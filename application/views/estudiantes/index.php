<?php if ($this->session->userdata('usuario')->tipo_usu == 'ESTUDIANTE') : ?>
  <div class="row" style="width: 100%">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark col-md-3" style="width: 280px; height: 100vh;">
      <a href="<?php echo site_url('estudiantes/inicio') ?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none gap-3" style="display: flex; flex-direction: column; justify-content: center;">
        <div>
          <img src="<?php echo base_url('assets/logo/Logo.svg') ?>" width="150px">
        </div>
        <div class="text-center">
          <i class="fa-sharp fa-solid fa-chalkboard-user" style="padding-left: 10px;"></i>
          <span class="fs-4 text-center">Módulo Estudiantes</span>
        </div>
      </a>
      <hr>
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          <a id="botonInicio" href="#" class="nav-link text-white active" aria-current="page">
            <i class="fa-solid fa-house" style="margin-right: 5px;"></i>
            <span>Inicio</span>
          </a>
        </li>
        <li>
          <a id="botonVerificarVinculacion" href=" #" class="nav-link text-white">
            <i class="fa-solid fa-folder-open" style="margin-right: 5px;"></i>
            Verificar Vinculación
          </a>
        </li>
      </ul>
      <hr>
      <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="<?php echo base_url('assets/fotos_usuarios/estudiantes/') . $this->session->userdata('usuario')->foto_usu ?>" alt="" width="32" height="32" class="rounded-circle me-2">
          <strong><?php echo $this->session->userdata('usuario')->nombres_usu . ' ' . $this->session->userdata('usuario')->apellidos_usu ?></strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
          <li><a class="dropdown-item" href="#">New project...</a></li>
          <li><a class="dropdown-item" href="#">Settings</a></li>
          <li><a class="dropdown-item" href="#">Profile</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><button class="dropdown-item" id="botonCerrarSesion">Cerrar Sesión</button></li>
        </ul>
      </div>
    </div>
    <div class="col-md-9">
      <div class="overflow-hidden">
        <div class="container-fluid col-xxl-8">
          <div id="contenedorCambiable" class="row flex-lg-nowrap align-items-center g-5">

          </div><!-- /lc-block -->
        </div>
      </div>
    </div>
  </div>

  <script>
    //Para cambiar el contenido de la página
    $(document).ready(function() {
      $.ajax({
        url: '<?php echo site_url('estudiantes/getUsuariosEstudiantesId/') . $this->session->userdata('usuario')->id_usu; ?>',
        dataType: 'json',
        success: function(data) {
          if (data.status == 'success') {
            var id_est = data.estudiante[0].id_est;
            $('#contenedorCambiable').load('<?php echo site_url('estudiantes/home') ?>');
            $('#botonInicio').click(function() {
              $('#contenedorCambiable').load('<?php echo site_url('estudiantes/home') ?>');
              $('#botonInicio').addClass('active');
              $('#botonVerificarVinculacion').removeClass('active');
            });
            $('#botonVerificarVinculacion').click(function() {
              console.log(id_est);
              $('#contenedorCambiable').load('<?php echo site_url('estudiantes/verificarVinculacion/') ?>' + id_est);
              $('#botonInicio').removeClass('active');
              $('#botonVerificarVinculacion').addClass('active');
            });
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
    });
  </script>
<?php else : ?>
  <?php redirect('logins') ?>
<?php endif; ?>