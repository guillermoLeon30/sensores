<script>

//----------------------GENERAR TABLA-------------------------
$(document).on('click', '.pagination a', function (e) {
  e.preventDefault();
  var page = $(this).attr('href').split('page=')[1];
  var filtro = $('#buscar').val();
  
  generarTabla(page, filtro);
});

function generarTabla(page, filtro) {
  $.ajax({
    headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
    url: '{{ url('empresas') }}',
    type: 'GET',
    data: {'page':page, 'filtro':filtro},
    dataType: 'json',
    beforeSend: function () {
      $('.box').append('<div class="overlay">'+
                         '<i class="fa fa-refresh fa-spin"></i>'+
                       '</div>');
    },
    success: function (data) {
      $('#tEmpresas').html(data);
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
function activar(idEmpresa) {
	var page = $('.pagination li.active span').html();
  var filtro = $('#buscar').val();

	$.ajax({
    headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
    url: '{{ url('empresas/activar') }}',
    type: 'POST',
    data: {
    	'page':page, 
    	'filtro':filtro,
    	'idEmpresa':idEmpresa
    },
    dataType: 'json',
    beforeSend: function () {
      $('.box').append('<div class="overlay">'+
                         '<i class="fa fa-refresh fa-spin"></i>'+
                       '</div>');
    },
    success: function (data) {
      $('#tEmpresas').html(data);
      $('.overlay').detach();
    },
    error: function () {
    	$('.overlay').detach();
      mensaje2('error', 'Ocurrio un error al guardar', '#mensaje');
    }
  });
}

function desactivar(idEmpresa) {
	var page = $('.pagination li.active span').html();
  var filtro = $('#buscar').val();

	$.ajax({
    headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
    url: '{{ url('empresas/desactivar') }}',
    type: 'POST',
    data: {
    	'page':page, 
    	'filtro':filtro,
    	'idEmpresa':idEmpresa
    },
    dataType: 'json',
    beforeSend: function () {
      $('.box').append('<div class="overlay">'+
                         '<i class="fa fa-refresh fa-spin"></i>'+
                       '</div>');
    },
    success: function (data) {
      $('#tEmpresas').html(data);
      $('.overlay').detach();
    },
    error: function () {
    	$('.overlay').detach();
      mensaje2('error', 'Ocurrio un error al guardar', '#mensaje');
    }
  });
}

</script>