<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use App\Mail\CompraProveedorMail;
use App\Models\InventarioSucursalLote;
use App\Models\MovimientoInventario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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

    public function enviarCorreo(Compra $compra){
        $compra->load('detalles.producto','proveedor');

        $compra->estado = 'Enviado al Proveedor';
        $compra->save();

        $proveedorEmail = $compra->proveedor->email;

        Mail::to($proveedorEmail)->send(new CompraProveedorMail($compra));
        return redirect()->route('compras.edit', $compra->id)
            ->with('mensaje', 'Correo Enviado Exitosamente al Proveedor')
            ->with('icono', 'success');
    }

    public function finalizarCompra(Request $request,Compra $compra){
        $compra->load('detalles.producto','proveedor');
        

        if($compra->detalles->isEmpty()){
            return redirect()->back()
                ->with('mensaje', 'No se pueden finalizar compras sin productos')
                ->with('icono', 'error');
        }

        $request->validate([
            'sucursal_id'=> 'required',
        ]);

        DB::beginTransaction();
        try {

            foreach($compra->detalles as $detalle) {
                $lote = $detalle->lote;
                $producto = $detalle->producto;

                //Actualizar la cantidad del lote en la tabla lotes
                $lote->cantidad_actual = $lote->cantidad_actual + $detalle->cantidad;
                $lote->save();

                //actualizar o crear el registro en inventario_sucursal_lote
                $inventarioLote = InventarioSucursalLote::firstOrCreate([
                    'lote_id' => $lote->id,
                    'sucursal_id' => $request->sucursal_id,
                    'cantidad_en_sucursal' => 0
                ]);
                $inventarioLote->cantidad_en_sucursal = $inventarioLote->cantidad_en_sucursal + $detalle->cantidad;
                $inventarioLote->save();

                //Registrar el movimiento en la tabla movimiento_inventario
                $movimientoInventario = MovimientoInventario::create([
                    'producto_id' => $producto->id,
                    'lote_id' => $lote->id,
                    'sucursal_id' => $request->sucursal_id,
                    'tipo_movimiento' => 'Entrada',
                    'cantidad' => $detalle->cantidad,
                    'fecha' => now(),
                ]);
            }

            //Actualizar el estado de la compra
            $compra->estado = 'Recibido';
            $compra->save();

            DB::commit();

            return redirect()->route('compras.index')
                ->with('mensaje', 'La Compra se Finalizó Exitosamente')
                ->with('icono', 'success');

        }catch(\Exception $e){
            DB::rollBack();
            dd('Error al Finalizar la Compra, '.$e->getMessage());
        }
       
    }

    public function show($id)
    {
        $compra = Compra::findOrFail($id);
        $compra->load('detalles.producto','proveedor');

        $movimientoEntrada = MovimientoInventario::whereHas('lote', function ($query) use ($compra) {
                $query->whereIn('id', $compra->detalles->pluck('lote_id'));
            })->where('tipo_movimiento', 'Entrada')->first();

            $sucursal_destino = null;
            if ($movimientoEntrada) {
                $sucursal_destino = Sucursal::find($movimientoEntrada->sucursal_id);
            }

        return view('admin.compras.show', compact('compra', 'sucursal_destino'));
    }

    public function destroy($id)
    {
        $compra = Compra::with('detalles')->findOrFail($id);
        DB::beginTransaction();
        try {
            foreach($compra->detalles as $detalle) {
                $lote = $detalle->lote;
                //Eliminar el lote asociado al detalle de la compra
                $lote->delete();
                $detalle->delete();
            }

            $compra->delete();

            DB::commit();

            return redirect()->route('compras.index')
                ->with('mensaje', 'La Compra se Eliminó Exitosamente')
                ->with('icono', 'success');

        }catch(\Exception $e){
            DB::rollBack();
            dd('Error al Eliminar la Compra, '.$e->getMessage());
        }
    }
}
