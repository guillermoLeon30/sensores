<script>

$('#formIngresarEquipo').submit(function (e) {
  e.preventDefault();

  $.ajax({
    headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
    url: '{{ url('equipo') }}',
    type: 'POST',
    data: equipo(),
    dataType: 'json',
    beforeSend: function () {
      $('#modalNuevoEquipo').modal('hide');
      $('.box').append('<div class="overlay">'+
                        '<i class="fa fa-refresh fa-spin"></i>'+
                       '</div>');
    },
    success: function (data) {
      $('#tEquipos').html(data);
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

function equipo() {
  var equipo = {};

  $('#formIngresarEquipo [name]').each(function (i, nodo) {
    equipo[nodo.name] = nodo.value;
  });

  equipo['page'] = $('.pagination li.active span').html();
  equipo['filtro'] = $('#buscar').val();

  return equipo;
}

</script>