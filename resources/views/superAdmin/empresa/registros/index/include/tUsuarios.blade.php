<div class="box-body table-responsive no-padding">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Email</th>
        <th>Celular</th>
        <th>Documento</th>
        <th>Rol</th>
        <th>Estado</th>
        <th>Opciones</th>
      </tr>
    </thead>

    <tbody>
      @foreach($usuarios as $usuario)
        <tr>
          <td>{{ $usuario->name }}</td>
          <td>{{ $usuario->email }}</td>
          <td>{{ $usuario->celular }}</td>
          <td>{{ $usuario->tipoDocumento->valor }}: {{ $usuario->documento }}</td>
          <td>{{ $usuario->rol->valor }}</td>
          <td>
            @if($usuario->estado->valor === 'activo')
              <a href="">
                <span class="label label-success">Activo</span>  
              </a>
            @else
              <a href="">
                <span class="label label-danger">Inactivo</span>
              </a>
            @endif
          </td>
          <td>
            <button class="btn btn-primary" onclick="editar({{ $usuario->id }})">
              <span class="fa fa-edit" aria-hidden="true"></span>
            </button>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="box-footer">
  {{ $usuarios->links('vendor.pagination.custom',['maxPages'=>5, 'offset'=>2]) }}
</div>