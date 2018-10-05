<script>

$('#formIngresar').submit(function (e) {
	e.preventDefault();

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
    url: '{{ url('categorias') }}',
    type: 'POST',
    data: categoria(),
    dataType: 'json',
    beforeSend: function () {
      $('#modalNuevo').modal('hide');
      $('.box').append('<div class="overlay">'+
                        '<i class="fa fa-refresh fa-spin"></i>'+
                       '</div>');
    },
    success: function (data) {
    	$('#tCategorias').html(data);
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

function categoria() {
	var categoria = {};

	$('#formIngresar input').each(function (i, nodo) {
		categoria[nodo.name] = nodo.value;
	});

	categoria['page'] = $('li.page-item.active span').html();
	categoria['filtro'] = $('#buscar').val();

	return categoria;
}

</script>