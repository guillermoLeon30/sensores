<script>

//----------------------GENERAR TABLA-------------------------
$(document).on('click', '.page-item a', function (e) {
  e.preventDefault();
  var page = $(this).attr('href').split('page=')[1];
  var filtro = $('#buscar').val();
  
  generarTabla(page, filtro);
});

function generarTabla(page, filtro) {
  $.ajax({
    headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
    url: '{{ url('categorias') }}',
    type: 'GET',
    data: {'page':page, 'filtro':filtro},
    dataType: 'json',
    beforeSend: function () {
      $('.box').append('<div class="overlay">'+
                         '<i class="fa fa-refresh fa-spin"></i>'+
                       '</div>');
    },
    success: function (data) {
      $('#tCategorias').html(data);
      $('.overlay').detach();
    }
  });
}

//---------------------BUSCAR-------------------------------
$('#buscar').on('keyup', function () {
  var filtro = $('#buscar').val();

  generarTabla(1, filtro);
});

//---------------------ACTIVAR/DESACTIVAR------------------
function activar(idCategoria) {
	var page = $('li.page-item.active span').html();
  var filtro = $('#buscar').val();

	$.ajax({
    headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
    url: '{{ url('categorias/activar') }}',
    type: 'POST',
    data: {
    	'page':page, 
    	'filtro':filtro,
    	'idCategoria':idCategoria
    },
    dataType: 'json',
    beforeSend: function () {
      $('.box').append('<div class="overlay">'+
                         '<i class="fa fa-refresh fa-spin"></i>'+
                       '</div>');
    },
    success: function (data) {
      $('#tCategorias').html(data);
      $('.overlay').detach();
    },
    error: function () {
    	$('.overlay').detach();
      mensaje2('error', 'Ocurrio un error al guardar la categoria', '#mensaje');
    }
  });
}

function desactivar(idCategoria) {
	var page = $('li.page-item.active span').html();
  var filtro = $('#buscar').val();

	$.ajax({
    headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
    url: '{{ url('categorias/desactivar') }}',
    type: 'POST',
    data: {
    	'page':page, 
    	'filtro':filtro,
    	'idCategoria':idCategoria
    },
    dataType: 'json',
    beforeSend: function () {
      $('.box').append('<div class="overlay">'+
                         '<i class="fa fa-refresh fa-spin"></i>'+
                       '</div>');
    },
    success: function (data) {
      $('#tCategorias').html(data);
      $('.overlay').detach();
    },
    error: function () {
    	$('.overlay').detach();
      mensaje2('error', 'Ocurrio un error al guardar la categoria', '#mensaje');
    }
  });
}

</script>