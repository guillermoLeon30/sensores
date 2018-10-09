<div class="box box-primary">
  <div class="box-header">
    <h2 class="box-title"></h2>

    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modalNuevoUsuario">
      <i class="glyphicon glyphicon-plus"></i>Nuevo
    </button> 

    <div class="box-tools">
      <div class="input-group input-group-sm" style="width: 200px;">
        <input type="text" id="buscarUsuario" class="form-control pull-right" placeholder="Buscar">

        <div class="input-group-addon">
          <i class="fa fa-search"></i>
        </div>
      </div>
    </div>
  </div>

  <div id="tUsuarios">
    @include('superAdmin.empresa.registros.index.include.tUsuarios')
  </div>
</div>
