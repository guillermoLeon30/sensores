@extends('superAdmin.plantilla.principal')

@section('encabezadoContenido')
  <section class="content-header">
      <h1>
        Registos de Empresa: {{ $empresa->nombre }}
      </h1>
    </section>
@endsection

@section('contenido')
  <div class="row">
    <div class="col-xs-12 col-sm-9" id="mensaje"></div>
    
    <div class="col-sm-9 col-xs-12">
      
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs pull-right">
            <li class="active"><a href="#tabUsuarios" data-toggle="tab">Usuarios</a></li>
            <li><a href="#tabEquipos" data-toggle="tab">Equipos</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tabUsuarios">
              @include('superAdmin.empresa.registros.index.include.tabUsuarios')
            </div>
            <div class="tab-pane" id="tabEquipos">
              @include('superAdmin.empresa.registros.index.include.tabEquipos')
            </div>
          </div>
        </div>
      
    </div>
  </div>

  @include('superAdmin.empresa.registros.index.include.modalNuevoUsuario')
  @include('superAdmin.empresa.registros.index.include.modalNuevoEquipo')
@endsection

@push('js')
  @include('librerias.js.mensajes')
  @include('superAdmin.empresa.registros.index.js.jsModalNuevoUsuario')
  @include('superAdmin.empresa.registros.index.js.jsModalNuevoEquipo')
@endpush