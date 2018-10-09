<div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Ingresar Empresa</h4>
      </div>
        <form id="formIngresar" class="form-horizontal">
          <div class="modal-body">
            <div class="form-group">
              <label class="col-xs-3 control-label">Nombre</label>
							<div class="col-xs-9">
								<input class="form-control" type="text" name="nombre">
							</div>
            </div>

            <div class="form-group">
              <label class="col-xs-3 control-label">Direccion</label>
              <div class="col-xs-9">
                <input class="form-control" type="text" name="direccion">
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-3 control-label">Tipo de documento</label>
              <div class="col-xs-9">
                <select class="form-control" name="tipo_documento_id">
                  @foreach($tipoDocumentos as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->valor }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-3 control-label">Documento</label>
              <div class="col-xs-9">
                <input class="form-control" type="text" name="documento">
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
