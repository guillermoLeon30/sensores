<script>

$('#formIngresar').submit(function (e) {
  e.preventDefault();

  $.ajax({
    headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
    url: '{{ url('sensor') }}',
    type: 'POST',
    data: sensor(),
    dataType: 'json',
    beforeSend: function () {
      $('#modalNuevo').modal('hide');
      $('.box').append('<div class="overlay">'+
                        '<i class="fa fa-refresh fa-spin"></i>'+
                       '</div>');
    },
    success: function (data) {
      $('#tSensores').html(data);
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

function sensor() {
  var sensor = {};

  $('#formIngresar [name]').each(function (i, nodo) {
    sensor[nodo.name] = nodo.value;
  });

  sensor['page'] = $('.pagination li.active span').html();
  sensor['filtro'] = $('#buscar').val();

  return sensor;
}

</script>