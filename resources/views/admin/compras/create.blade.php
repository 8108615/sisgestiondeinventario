@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb" style="font-size: 18pt">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/compras') }}">Compras</a></li>
            <li class="breadcrumb-item active" aria-current="page">Creacion de una Compras</li>
        </ol>
    </nav>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>Paso 1 | Llene los Datos del Formulario  </b></h3>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: block;">
                    <form action="{{ url('/admin/compras/create') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="proveedor_id">Proveedores <b style="color: red">(*)</b></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-users"></i></span>
                                        </div>
                                        <select name="proveedor_id" id="" class="form-control" required>
                                            <option value="">Seleccione un Proveedor</option>
                                            @foreach ($proveedores as $proveedor)
                                                <option value="{{ $proveedor->id }}"
                                                    {{ old('proveedor_id') == $proveedor->id ? 'selected' : '' }}>
                                                    {{ $proveedor->nombre." | ".$proveedor->empresa }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('proveedor_id')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="fecha">Fecha de la Compra <b style="color: red">(*)</b></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="date" name="fecha" id="fecha" class="form-control"
                                            value="{{ old('fecha') }}" required>
                                    </div>
                                    @error('fecha')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="observaciones">Observaciones </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-list"></i></span>
                                        </div>
                                        <input type="text" name="observaciones" id="observaciones" class="form-control"
                                            value="{{ old('observaciones') }}">
                                    </div>
                                    @error('observaciones')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ url('/admin/compras') }}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Crear Compra y Añadir Productos</button>
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

@stop

@section('js')

@stop
