<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Panel de Administración</title>
  @include('superAdmin.plantilla.include.headCss')
  @yield('css')
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include('superAdmin.plantilla.include.headerControlPanel')

  <!-- Left side column. contains the logo and sidebar -->
  @include('superAdmin.plantilla.include.menuPrincipal')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      @yield('encabezadoContenido')
    </section>
    <br>
    <!-- Main content -->
    <section class="container">
      @yield('contenido')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('superAdmin.plantilla.include.pieControlPanel')
  
</div>
<!-- ./wrapper -->

@include('superAdmin.plantilla.include.js')
@stack('js')
</body>
</html>
