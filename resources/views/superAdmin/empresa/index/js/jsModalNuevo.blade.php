<script>

$('#formIngresar').submit(function (e) {
  e.preventDefault();

  $.ajax({
    headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
    url: '{{ url('empresas') }}',
    type: 'POST',
    data: empresa(),
    dataType: 'json',
    beforeSend: function () {
      $('#modalNuevo').modal('hide');
      $('.box').append('<div class="overlay">'+
                        '<i class="fa fa-refresh fa-spin"></i>'+
                       '</div>');
    },
    success: function (data) {
      $('#tEmpresas').html(data);
      $('.overlay').detach();
      toastr.success('Se ingresó el registro correctamente.');
    },
    error: function (data) {
      $('.overlay').detach();
      if (data.status == 422) {
        mensaje('error', data, '#mensaje');
      } else {
        mensaje2('error', 'Se produjo un error en la conexión.', '#mensaje');
      }
    }
  });
});

function empresa() {
  var empresa = {};

  $('#formIngresar [name]').each(function (i, nodo) {
    empresa[nodo.name] = nodo.value;
  });

  empresa['page'] = $('.pagination li.active span').html();
  empresa['filtro'] = $('#buscar').val();

  return empresa;
}

</script>