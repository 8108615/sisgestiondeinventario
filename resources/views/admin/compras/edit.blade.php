@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb" style="font-size: 18pt">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/compras') }}">Compras</a></li>
            <li class="breadcrumb-item active" aria-current="page">Compra Nro {{ $compra->id }}</li>
        </ol>
    </nav>
    <hr>
@stop


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><b>Paso 1 | Compra Creada </b></h3>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: block;">

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="proveedor_id">Proveedores </label>
                                <p>{{ $compra->proveedor->nombre }}</p>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="fecha">Fecha de la Compra </label>
                                <p>{{ $compra->fecha }}</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="observaciones">Observaciones </label>
                                <p>{{ $compra->observaciones }}</p>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="fecha">Estado de la Compra </label>
                                <p>{{ $compra->estado }}</p>
                            </div>
                        </div>
                        <div class="col-md-2">

                        </div>


                    </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>Paso 2 | Agregar Productos </b></h3>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: block;">
                    <!--    <livewire:counter /> -->

                    <livewire:admin.compras.items-compra :compra="$compra" />
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title"><b>Paso 3 | Finalizar Compra </b></h3>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: block;">
                    <form action="{{ route('compras.finalizarCompra', $compra) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sucursal_id">Sucursal <b style="color: red">(*)</b></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                                        </div>
                                        <select name="sucursal_id" id="" class="form-control" required>
                                            <option value="">Seleccione una Sucursal...</option>
                                            @foreach ($sucursales as $sucursal)
                                                <option value="{{ $sucursal->id }}"
                                                    {{ old('sucursal_id') == $sucursal->id ? 'selected' : '' }}>
                                                    {{ $sucursal->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('proveedor_id')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                                <hr>
                                <div class="form-group">
                                    <a href="{{ route('compras.enviarCorreo', $compra) }}" class="btn btn-primary"><i
                                            class="fas fa-envelope"></i> Enviar Correo al Proveedor</a>
                                    <button class="btn btn-success" type="submit"><i class="fas fa-check"></i> Finalizar Compra</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>





@stop

@section('css')
    <style>
        .select2-container .select2-selection--single {
            height: 40px;
        }
    </style>
    @livewireStyles
@stop

@section('js')

    @livewireScripts
@stop
