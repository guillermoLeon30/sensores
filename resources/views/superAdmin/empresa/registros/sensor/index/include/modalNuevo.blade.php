<div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Ingresar Sensor</h4>
      </div>
        <form id="formIngresar" class="form-horizontal">
          <input type="hidden" name="equipo_id" value="{{ $equipo->id }}">
          <div class="modal-body">
            <div class="form-group">
              <label class="col-xs-3 control-label">Tipo</label>
              <div class="col-xs-9">
                <select class="form-control" name="tipo_sensor_id">
                  @foreach($tipos as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->valor }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-xs-3 control-label">Unidad</label>
              <div class="col-xs-9">
                <select class="form-control" name="unidad_id">
                  @foreach($unidades as $unidad)
                    <option value="{{ $unidad->id }}">{{ $unidad->valor }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-3 control-label">Marca</label>
							<div class="col-xs-9">
								<input class="form-control" type="text" name="marca">
							</div>
            </div>

            <div class="form-group">
              <label class="col-xs-3 control-label">Modelo</label>
              <div class="col-xs-9">
                <input class="form-control" type="text" name="modelo">
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-3 control-label">Serie</label>
              <div class="col-xs-9">
                <input class="form-control" type="text" name="serie">
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-3 control-label">Ubicacion</label>
              <div class="col-xs-9">
                <textarea class="form-control" rows="3" name="ubicacion"></textarea>
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-3 control-label">Descripcion</label>
              <div class="col-xs-9">
                <textarea class="form-control" rows="3" name="descripcion"></textarea>
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-3 control-label">Alarma maxima</label>
              <div class="col-xs-9">
                <textarea class="form-control" rows="3" name="alarma_maxima"></textarea>
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-3 control-label">Alarma minima</label>
              <div class="col-xs-9">
                <textarea class="form-control" rows="3" name="alarma_minima"></textarea>
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
