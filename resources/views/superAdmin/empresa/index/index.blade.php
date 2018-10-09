@extends('superAdmin.plantilla.principal')

@section('encabezadoContenido')
  <div class="box-header">
    <h2 class="box-title" style="font-size: 30px">Empresas</h2>
  </div>
@endsection

@section('contenido')
  <div class="row">
    <div id="mensaje" class="col-xs-10"></div>

    <div class="col-xs-10 col-sm-10">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"></h3>
          <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modalNuevo">
            <i class="glyphicon glyphicon-plus"></i>Nuevo
          </button> 

          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 200px;">
              <input type="text" id="buscar" class="form-control pull-right" placeholder="Buscar">

              <div class="input-group-addon">
                <i class="fa fa-search"></i>
              </div>
            </div>
          </div>
        </div>
        
        <div id="tEmpresas">
          @include('superAdmin.empresa.index.include.tEmpresas')
        </div>
      </div>
    </div>
  </div>

  @include('superAdmin.empresa.index.include.modalNuevo')
@endsection

@push('js')
  @include('librerias.js.mensajes')
  @include('superAdmin.empresa.index.js.jsPrincipal')
  @include('superAdmin.empresa.index.js.jsModalNuevo')
@endpush