<?php if ($this->session->userdata('usuario')->tipo_usu == 'ADMIN') : ?>
  <div class="order-lg-1 w-100" style="height: 100vh;">
    <img style="clip-path: polygon(25% 0%, 100% 0%, 100% 99%, 0% 100%); height: 100vh;" src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" sizes="(max-width: 1080px) 100vw, 1080px" width="2160" height="768">
  </div>
  <div class="col-lg-6 col-xl-5 text-center text-lg-start pt-lg-5 mt-xl-4">
    <div class="lc-block mb-4">
      <div editable="rich">
        <h1 class="fw-bold display-4">Bienvenido al Sistema de Gestión</h1>
      </div>
    </div>

    <div class="lc-block mb-5">
      <div editable="rich">
        <p class="rfs-8">Aquí podrás controlar todo el proceso de gestión de usuarios y empresas de vinculación con la sociedad.</p>
      </div>
    </div>

    <div class="lc-block mb-6"><a class="btn btn-primary px-4 me-md-2 btn-lg" href="#" role="button">Saber más</a>
    </div>

    <div class="lc-block" style="padding-top: 25px;">
      <div editable="rich">
        <p class="fw-bold"> Estas empresas confían en nosotros:</p>
      </div>
    </div>
    <div class="row">
      <div class="lc-block col-3"><img class="img-fluid wp-image-975" src="https://lclibrary.b-cdn.net/starters/wp-content/uploads/sites/15/2021/11/motorola.svg" srcset="" sizes="" alt="" width="" height="300"></div>
      <div class="lc-block col-3"><img class="img-fluid wp-image-977" src="https://lclibrary.b-cdn.net/starters/wp-content/uploads/sites/15/2021/11/asus.svg" srcset="" sizes="" alt="" width="" height="300"></div>
      <div class="lc-block col-3"><img class="img-fluid wp-image-974" src="https://lclibrary.b-cdn.net/starters/wp-content/uploads/sites/15/2021/11/sony.svg" srcset="" sizes="" alt="" width="" height="300"></div>
      <div class="lc-block col-3"><img class="img-fluid wp-image-967" src="https://lclibrary.b-cdn.net/starters/wp-content/uploads/sites/15/2021/11/samsung-282297.svg" srcset="" sizes="" alt="" width="" height="300"></div>
    </div>
  </div>
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