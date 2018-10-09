<div class="modal fade" id="modalNuevoEquipo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Ingresar Equipo</h4>
      </div>
        <form id="formIngresarEquipo" class="form-horizontal">
          <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
          <div class="modal-body">
            <div class="form-group">
              <label class="col-xs-2 control-label">Nombre</label>
              <div class="col-xs-10">
                <input class="form-control" type="text" name="nombre">
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-2 control-label">Marca</label>
              <div class="col-xs-10">
                <input class="form-control" type="text" name="marca">
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-2 control-label">Modelo</label>
              <div class="col-xs-10">
                <input class="form-control" type="text" name="modelo">
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-2 control-label">Imagen</label>
              <div class="col-xs-10">
                <input type="file" name="imagen">
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-2 control-label">Descripcion</label>
              <div class="col-xs-10">
                <textarea class="form-control" rows="3" placeholder="Enter ..." name="descripcion"></textarea>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success">Ingresar</button>
          </div>
        </form>
    </div>
  </div>
</div>
