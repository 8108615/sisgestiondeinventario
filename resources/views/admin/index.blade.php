@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Admin</p>
    <hr>
    
    <div class="row">
        
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <a href="{{ url('/admin/sucursales') }}">
                    <span class="info-box-icon bg-info">
                        <img src="{{ url('/img/edificio.gif') }}" alt="">
                    </span>
                </a>

              <div class="info-box-content">
                <span class="info-box-text"><b>Sucursales</b></span>
                <span class="info-box-number">{{ $total_sucursales }} Sucursales</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <a href="{{ url('/admin/categorias') }}">
                    <span class="info-box-icon bg-info">
                        <img src="{{ url('/img/carpetas.gif') }}" alt="">
                    </span>
                </a>

              <div class="info-box-content">
                <span class="info-box-text"><b>Categorias</b></span>
                <span class="info-box-number">{{ $total_categorias }} Categorias</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <a href="{{ url('/admin/productos') }}">
                    <span class="info-box-icon bg-info">
                        <img src="{{ url('/img/cajas.gif') }}" alt="">
                    </span>
                </a>

              <div class="info-box-content">
                <span class="info-box-text"><b>Productos</b></span>
                <span class="info-box-number">{{ $total_productos }} Productos</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <a href="{{ url('/admin/proveedores') }}">
                    <span class="info-box-icon bg-info">
                        <img src="{{ url('/img/camion.gif') }}" alt="">
                    </span>
                </a>

              <div class="info-box-content">
                <span class="info-box-text"><b>Proveedores</b></span>
                <span class="info-box-number">{{ $total_proveedores }} Proveedores</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <a href="{{ url('/admin/compras') }}">
                    <span class="info-box-icon bg-info">
                        <img src="{{ url('/img/compras.gif') }}" alt="">
                    </span>
                </a>

              <div class="info-box-content">
                <span class="info-box-text"><b>Compras</b></span>
                <span class="info-box-number">{{ $total_compras }} Compras</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <a href="{{ url('/admin/lotes') }}">
                    <span class="info-box-icon bg-info">
                        <img src="{{ url('/img/notificaciones.gif') }}" alt="">
                    </span>
                </a>

              <div class="info-box-content">
                <span class="info-box-text"><b>Lotes Vencidos</b></span>
                <span class="info-box-number">{{ $total_lotes_vencidos }} Lotes Vencidos</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop