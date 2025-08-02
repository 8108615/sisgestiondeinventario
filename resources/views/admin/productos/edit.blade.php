@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb" style="font-size: 18pt">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/productos') }}">Productos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Actualizacion de Datos de un Producto</li>
        </ol>
    </nav>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title"><b>Llene los Datos del Formulario</b></h3>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: block;">
                    <form action="{{ url('/admin/producto/'.$producto->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre">Categoria <b style="color: red">(*)</b></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                                </div>
                                                <select name="categoria_id" id="" class="form-control" required>
                                                    <option value="">Seleccione una Categoria</option>
                                                    @foreach ($categorias as $categoria)
                                                        <option value="{{ $categoria->id }}"
                                                            {{ old('categoria_id', $producto->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                                            {{ $categoria->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('nombre')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="codigo">Codigo <b style="color: red">(*)</b></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                                </div>
                                                <input type="text" value="{{ old('codigo', $producto->codigo) }}" class="form-control"
                                                    id="codigo" name="codigo"
                                                    placeholder="Ingrese el Codigo del Producto..." required>
                                            </div>
                                            @error('codigo')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre">nombre <b style="color: red">(*)</b></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-box"></i></span>
                                                </div>
                                                <input type="text" value="{{ old('nombre', $producto->nombre) }}" class="form-control"
                                                    id="nombre" name="nombre"
                                                    placeholder="Ingrese el Nombre del Producto..." required>
                                            </div>
                                            @error('nombre')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="descripcion">Descripcion <b style="color: red">(*)</b></label>
                                            <div class="editor-wrapper">
                                                <textarea id="descripcion" name="descripcion">{{ $producto->descripcion }}</textarea>
                                            </div>
                                            @error('descripcion')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="precio_compra">Precio Compra <b style="color: red">(*)</b></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-money-bill-wave"></i></span>
                                                </div>
                                                <input style="text-align: center" type="number" value="{{ old('precio_compra', $producto->precio_compra) }}" class="form-control"
                                                    id="precio_compra" name="precio_compra" required>
                                                     
                                            </div>
                                            @error('precio_compra')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="precio_venta">Precio Venta <b style="color: red">(*)</b></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-money-bill-wave"></i></span>
                                                </div>
                                                <input style="text-align: center" type="number" value="{{ old('precio_venta', $producto->precio_venta) }}" class="form-control"
                                                    id="precio_venta" name="precio_venta" required>
                                            </div>
                                            @error('precio_venta')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="stock_minimo">Stock Minimo <b style="color: red">(*)</b></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-arrow-down"></i></span>
                                                </div>
                                                <input style="text-align: center" type="number" value="{{ old('stock_minimo', $producto->stock_minimo) }}" class="form-control"
                                                    id="stock_minimo" name="stock_minimo" required>
                                            </div>
                                            @error('stock_minimo')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div> 
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="stock_maximo">Stock Maximo <b style="color: red">(*)</b></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-arrow-up"></i></span>
                                                </div>
                                                <input style="text-align: center" type="number" value="{{ old('stock_maximo', $producto->stock_maximo) }}" class="form-control"
                                                    id="stock_maximo" name="stock_maximo" required>
                                            </div>
                                            @error('stock_maximo')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div> 
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="unidad_medida">Unidad de Medida <b style="color: red">(*)</b></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-balance-scale"></i></span>
                                                </div>
                                                <select name="unidad_medida" id="unidad_medida" class="form-control">
                                                    <option value="">Seleccione una unidad</option>
                                                    <option value="unidad" {{ $producto->unidad_medida == "unidad" ? 'selected' : '' }}>Unidad </option>
                                                    <option value="kg" {{ $producto->unidad_medida == "kg" ? 'selected' : '' }}>Kg</option>
                                                    <option value="litro" {{ $producto->unidad_medida == "litro" ? 'selected' : '' }}>Litro</option>
                                                    <option value="paquete" {{ $producto->unidad_medida == "paquete" ? 'selected' : '' }}>Paquete</option>
                                                </select>
                                            </div>
                                            @error('unidad_medida')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="estado">Estado <b style="color: red">(*)</b></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                                                </div>
                                                <select name="estado" id="estado" class="form-control">
                                                    <option value="">Seleccione una opción</option>
                                                    <option value="1" {{ old('estado',$producto->estado) == 1 ? 'selected' : '' }}>Activo</option>
                                                    <option value="0" {{ old('estado',$producto->estado) == 0 ? 'selected' : '' }}>Inactivo</option>
                                                </select>
                                            </div>
                                            @error('estado')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="imagen">Imagen del Producto</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-image"></i></span>
                                                </div>
                                                <input type="file" class="form-control" id="imagen" name="imagen"
                                                    accept="image/*" onchange="previewImage(event)">
                                            </div>

                                            <br><br><br>
                                                 <img id="imgPreview" src="{{ asset('storage/'.$producto->imagen) }}" width="100%" alt="Vista previa de la imagen" />
                                                    <script>
                                                        function previewImage(event) {
                                                            const input = event.target;
                                                            const file = input.files[0];
                                                            if (file) {
                                                                const reader = new FileReader();
                                                                reader.onload = function(e) {
                                                                    const imgPreview = document.getElementById('imgPreview');
                                                                    imgPreview.src = e.target.result;
                                                                    imgPreview.style.display = 'block';
                                                            };
                                                            reader.readAsDataURL(file);
                                                        }
                                                    }
                                                 </script>
                                            @error('imagen')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ url('/admin/productos') }}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-success">Actualizar</button>
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
   .ck.ck-editor {
       width: 100% !important;
   }
   
   .ck-editor__editable {
       width: 100% !important;
       min-height: 300px;
       box-sizing: border-box;
   }
   
   .ck.ck-toolbar {
       flex-wrap: wrap;
   }
   
   @media (max-width: 768px) {
       .ck-editor__editable {
           min-height: 250px;
           padding: 10px;
       }
   }
</style>
@stop

@section('js')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
   ClassicEditor
       .create(document.querySelector('#descripcion'), {
           toolbar: {
               items: [
                   'heading', '|',
                   'bold', 'italic', 'underline', 'strikethrough', 'subscript', 'superscript', '|',
                   'link', 'bulletedList', 'numberedList', '|',
                   'outdent', 'indent', '|',
                   'alignment', '|',
                   'blockQuote', 'insertTable', 'mediaEmbed', '|',
                   'undo', 'redo', '|',
                   'fontBackgroundColor', 'fontColor', 'fontSize', 'fontFamily', '|',
                   'code', 'codeBlock', 'htmlEmbed', '|',
                   'sourceEditing'
               ],
               shouldNotGroupWhenFull: true
           },
           language: 'es'
       })
       .then(editor => {
           // Forzar responsive después de crear el editor
           const editorEl = editor.ui.view.element;
           editorEl.style.width = '100%';
           editorEl.querySelector('.ck-editor__editable').style.width = '100%';
       })
       .catch(error => {
           console.error(error);
       });
</script>
@stop
