@if(count($errors) > 0)
    <script>
        swal({
          position: 'center',
          type: 'error',
          title: "Periksa kembali data anda",
          showConfirmButton: false,
          timer: 1500
        });
</script>
@endif
