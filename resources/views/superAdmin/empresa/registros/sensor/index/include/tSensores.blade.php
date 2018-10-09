<div class="box-body table-responsive no-padding">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Codigo</th>
        <th>Estado</th>
        <th>Tipo</th>
        <th>Unidad</th>
        <th>Marca</th>
        <th>Modelo</th>        
        <th>Serie</th>
        <th>Ubicacion</th>
        <th>Opciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($sensores as $sensor)
        <tr>
          <td>{{ $sensor->id }}</td>
          <td>
            @if($sensor->estado->valor === 'activo')
              <span class="label label-success">Activo</span>  
            @else
              <span class="label label-danger">Inactivo</span>
            @endif
          </td>
          <td>{{ $sensor->tipo->valor }}</td>
          <td>{{ $sensor->unidad->valor }}</td>
          <td>{{ $sensor->marca }}</td>
          <td>{{ $sensor->modelo }}</td>
          <td>{{ $sensor->serie }}</td>
          <td>{{ $sensor->ubicacion }}</td>
          <td>
            <button class="btn btn-primary" onclick="editar({{ $sensor->id }})">
              <span class="fa fa-edit" aria-hidden="true"></span>
            </button>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="box-footer">
  {{ $sensores->links('vendor.pagination.custom',['maxPages'=>5, 'offset'=>2]) }}
</div>