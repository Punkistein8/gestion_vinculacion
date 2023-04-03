<script>
  $('#botonCerrarSesion').click((e) => {
    e.preventDefault()
    $.ajax({
      url: "<?php echo site_url('logins/cerrarSesion'); ?>",
      type: 'POST',
      dataType: 'json',
      success: (response) => {
        if (response.status === 'success') {
          Swal.fire({
            title: '¡Éxito!',
            text: response.message,
            icon: 'success',
            confirmButtonText: 'Ir a login'
          }).then(() => {
            window.location.href = "<?php echo site_url('logins'); ?>";
          })
        }
      }
    })
  })
</script>

<script type="text/javascript">
  function mostrarImagen(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#mostrar_foto').attr('src', e.target.result);
        $('#mostrar_foto_editar').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>

</body>

</html>