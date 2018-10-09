<script>

$('#formIngresarUsuario').submit(function (e) {
  e.preventDefault();

  $.ajax({
    headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
    url: '{{ url('user') }}',
    type: 'POST',
    data: user(),
    dataType: 'json',
    beforeSend: function () {
      $('#modalNuevoUsuario').modal('hide');
      $('.box').append('<div class="overlay">'+
                        '<i class="fa fa-refresh fa-spin"></i>'+
                       '</div>');
    },
    success: function (data) {
      $('#tUsuarios').html(data);
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

function user() {
  var user = {};

  $('#formIngresarUsuario [name]').each(function (i, nodo) {
    user[nodo.name] = nodo.value;
  });

  user['page'] = $('.pagination li.active span').html();
  user['filtro'] = $('#buscar').val();

  return user;
}

</script>