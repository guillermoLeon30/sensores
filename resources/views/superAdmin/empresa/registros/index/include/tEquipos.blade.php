<div class="box-body table-responsive no-padding">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Codigo</th>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Opciones</th>
      </tr>
    </thead>

    <tbody>
      @foreach($equipos as $equipo)
        <tr>
          <td>{{ $equipo->id }}</td>
          <td><img src="{{ $equipo->imagen }}" alt="equipo" width="100px" height="50px"></td>
          <td>{{ $equipo->nombre }}</td>
          <td>{{ $equipo->marca }}</td>
          <td>{{ $equipo->modelo }}</td>
          <td>
            <button class="btn btn-primary" onclick="editar({{ $equipo->id }})">
              <span class="fa fa-edit" aria-hidden="true"></span>
            </button>
            
            <a class="btn btn-warning" href="{{url('equipo')}}/{{$equipo->id}}/sensores">
              <span class="glyphicon glyphicon-magnet" aria-hidden="true"></span>
            </a>
            
            <a class="btn bg-purple" href="#">
              <span class="glyphicon glyphicon-sort-by-alphabet" aria-hidden="true"></span>
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="box-footer">
  {{ $equipos->links('vendor.pagination.custom',['maxPages'=>5, 'offset'=>2]) }}
</div>