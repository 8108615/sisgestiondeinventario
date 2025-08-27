@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb" style="font-size: 18pt">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/sucursales_por_lotes') }}">Inventario de Sucursales por Lotes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Listado de Inventario de Sucursales por Lotes</li>
        </ol>
    </nav>
    <hr>
@stop

@section('content')
    <div class="row">

        @foreach ($sucursales as $sucursal )
            
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <a href="{{ url('/admin/inventario/inventario_por_sucursal/sucursal/' . $sucursal->id) }}">
                    <span class="info-box-icon bg-info">
                        <img src="{{ url('/img/tienda-de-ropa.gif') }}" alt="">
                    </span>
                </a>

              <div class="info-box-content">
                <span class="info-box-text"><b>Sucursal {{ $sucursal->nombre }}</b></span>
                <span class="info-box-number">{{ $sucursal->total_inventario }} Productos en Stock</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        @endforeach

    </div>
@stop

@section('css')
    
@stop

@section('js')
    
@stop
