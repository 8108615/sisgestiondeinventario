<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Sucursal;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function index()
    {
        $compras = Compra::all();
        return view('admin.compras.index',compact('compras'));
    }

    public function create()
    {
        $proveedores = Proveedor::all();
        $productos = Proveedor::all();
        $sucursales = Sucursal::all();
        return view('admin.compras.create',compact('proveedores','productos','sucursales'));
    }

    public function store(Request $request)
    {
        //return response()->json(request()->all());
        $request->validate([
            'proveedor_id'=> 'required|exists:proveedors,id',
            'fecha'=> 'required|date',
            'observaciones'=> 'nullable|string|max:255',
        ]);

        $compra = new Compra;
        $compra->proveedor_id = $request->proveedor_id;
        $compra->fecha = $request->fecha;
        $compra->observaciones = $request->observaciones;
        $compra->total = 0; //Inicializa el total a 0
        $compra->estado = 'pendiente'; //Estado Inicial de la Compra
        $compra->save();

        return redirect()->route('compras.edit',$compra->id)
        ->with('mensaje','Compra Creada Exitosamente, Ahora Puede Añadir Productos')
        ->with('icono','success');
    }

    public function edit($id)
    {
        $compra = Compra::findOrFail($id);
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        $sucursales = Sucursal::all();
        return view('admin.compras.edit',compact('compra','proveedores','productos','sucursales'));
    }
}
