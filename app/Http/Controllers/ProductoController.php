<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los productos
        $productos = Producto::all();
        return view('admin.productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias =  Categoria::all();
        return view('admin.productos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return response()->json($request->all());
         $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'codigo' => 'required|unique:productos,codigo',
            'nombre' => 'required',
            'descripcion' => 'required',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'precio_compra' => 'required|numeric',
            'precio_venta' => 'required|numeric',
            'stock_minimo'=> 'required|integer',
            'stock_maximo'=> 'required|integer',
            'unidad_medida' => 'required',
            'estado' => 'required|boolean',
        ]);

        $producto = new Producto();
        $producto->categoria_id = $request->categoria_id;
        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->imagen = $request->file('imagen')->store('imagenes/productos', 'public');
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->stock_minimo = $request->stock_minimo;
        $producto->stock_maximo = $request->stock_maximo;
        $producto->unidad_medida = $request->unidad_medida;
        $producto->estado = $request->estado;
        $producto->save();

        return redirect()->route('productos.index')
        ->with('mensaje','Producto Creado Exitosamente')
        ->with('icono','success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('admin.productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        return view('admin.productos.edit', compact('producto','categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'categoria_id'=> 'required|exists:categorias,id',
            'codigo'=> 'required|unique:productos,codigo,'.$id,
            'nombre'=> 'required',
            'descripcion'=> 'required',
            'imagen'=> 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'precio_compra'=> 'required|numeric',
            'precio_venta'=> 'required|numeric',
            'stock_minimo'=> 'required|integer',
            'stock_maximo'=> 'required|integer',
            'unidad_medida'=> 'required',
            'estado'=> 'required|boolean',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->categoria_id = $request->categoria_id;
        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;

        if ($request->hasFile('imagen')) {
            Storage::disk('public')->delete($producto->imagen); //Rliminar la imagen
            $producto->imagen = $request->file('imagen')->store('imagenes/productos','public');
        }

        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->stock_minimo = $request->stock_minimo;
        $producto->stock_maximo = $request->stock_maximo;
        $producto->unidad_medida = $request->unidad_medida;
        $producto->estado = $request->estado;
        $producto->save();

        return redirect()->route('productos.index')
        ->with('mensaje','Producto Actualizado Exitosamente')
        ->with('icono','success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $producto = Producto::findOrFail($id);
        Storage::disk('public')->delete($producto->imagen); //Eliminar la Imagen del Producto
        $producto->delete();

        return redirect()->route('productos.index')
        ->with('mensaje','Producto Eliminado Exitosamente')
        ->with('icono','success');
    }
}
