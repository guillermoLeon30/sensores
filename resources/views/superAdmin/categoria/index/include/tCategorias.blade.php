<div class="box-body table-responsive no-padding">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Categoria</th>
        <th>Valor</th>
        <th>Opciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($categorias as $categoria)
        <tr>
          <td>{{ $categoria->categoria }}</td>
          <td>{{ $categoria->valor }}</td>
          <td>
            @if($categoria->estado == 'activo')
              <button class="btn btn-warning" onclick="desactivar({{ $categoria->id }})">
                <span class="fa fa-close" aria-hidden="true"></span>
              </button>
            @else
              <button class="btn btn-primary" onclick="activar({{ $categoria->id }})">
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
  {{ $categorias->onEachSide(5)->links() }}
</div>