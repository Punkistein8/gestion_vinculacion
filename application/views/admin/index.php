<?php if ($this->session->userdata('usuario')->tipo_usu == 'ADMIN') : ?>
  <div class="row" style="width: 100%">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark col-md-3" style="width: 280px; height: 100vh;">
      <a href="<?php echo site_url('administradores') ?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none gap-3" style="display: flex; flex-direction: column; justify-content: center;">
        <div>
          <img src="<?php echo base_url('assets/logo/Logo.svg') ?>" width="150px">
        </div>
        <div class="text-center">
          <i class="fa-solid fa-people-group"></i>
          <span class="fs-4">Módulo Administrativo</span>
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
          <a id="botonDocentes" href="#" class="nav-link text-white">
            <i class="fa-solid fa-user-tie" style="margin-right: 5px;"></i>
            Docentes
          </a>
        </li>
        <li>
          <a id="botonEmpresas" href=" #" class="nav-link text-white">
            <i class="fa-solid fa-building" style="margin-right: 5px;"></i>
            Empresas
          </a>
        </li>
        <li>
          <a id="botonEstudiantes" href="#" class="nav-link text-white">
            <i class="fa-sharp fa-solid fa-graduation-cap" style="margin-right: 5px;"></i>
            Estudiantes
          </a>
        </li>
      </ul>
      <hr>
      <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="<?php echo base_url('assets/fotos_usuarios/sin_imagen.png') ?>" alt="" width="32" height="32" class="rounded-circle me-2">
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
      $('#contenedorCambiable').load('<?php echo site_url('administradores/home') ?>');
      // $('#contenedorCambiable').load('<?php echo site_url('docentes') ?>');
      $('#botonInicio').click(function() {
        $('#contenedorCambiable').load('<?php echo site_url('administradores/home') ?>');
        $('#botonInicio').addClass('active');
        $('#botonDocentes').removeClass('active');
        $('#botonEmpresas').removeClass('active');
        $('#botonEstudiantes').removeClass('active');
      });
      $('#botonDocentes').click(function() {
        $('#contenedorCambiable').load('<?php echo site_url('docentes') ?>');
        $('#botonInicio').removeClass('active');
        $('#botonDocentes').addClass('active');
        $('#botonEmpresas').removeClass('active');
        $('#botonEstudiantes').removeClass('active');
      });
      $('#botonEmpresas').click(function() {
        $('#contenedorCambiable').load('<?php echo site_url('empresas') ?>');
        $('#botonInicio').removeClass('active');
        $('#botonDocentes').removeClass('active');
        $('#botonEmpresas').addClass('active');
        $('#botonEstudiantes').removeClass('active');
      });
      $('#botonEstudiantes').click(function() {
        $('#contenedorCambiable').load('<?php echo site_url('estudiantes') ?>');
        $('#botonInicio').removeClass('active');
        $('#botonDocentes').removeClass('active');
        $('#botonEmpresas').removeClass('active');
        $('#botonEstudiantes').addClass('active');
      });
    });
  </script>
<?php else : ?>
  <?php redirect('logins') ?>
<?php endif; ?>