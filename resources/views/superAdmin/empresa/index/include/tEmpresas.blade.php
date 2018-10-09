<div class="box-body table-responsive no-padding">
  <table class="table table-hover">
    <thead>
      <tr>
        <th></th>
        <th>Nombre</th>
        <th>Direccion</th>        
        <th>Documento</th>
        <th>Token</th>
        <th>Estado</th>
        <th>Opciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($empresas as $empresa)
        <tr>
          <td>
            <a href="{{ url('empresas/registro') }}/{{ $empresa->id }}" class="btn bg-olive">
              <span class="fa fa-clone" aria-hidden="true"></span>  
            </a>
          </td>
          <td>{{ $empresa->nombre }}</td>
          <td>{{ $empresa->direccion }}</td>
          <td>{{ $empresa->tipoDocumento->valor }}#: {{ $empresa->documento }}</td>
          <td>843535768434</td>
          <td>
            @if($empresa->estado->valor === 'activo')
              <span class="label label-success">Activo</span>  
            @else
              <span class="label label-danger">Inactivo</span>
            @endif
          </td>
          <td>
            @if($empresa->estado->valor === 'activo')
              <button class="btn btn-warning" onclick="desactivar({{ $empresa->id }})">
                <span class="fa fa-close" aria-hidden="true"></span>
              </button>
            @else
              <button class="btn btn-primary" onclick="activar({{ $empresa->id }})">
                <span class="fa fa-check" aria-hidden="true"></span>
              </button>
            @endif
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="box-footer">
  {{ $empresas->links('vendor.pagination.custom',['maxPages'=>5, 'offset'=>2]) }}
</div>