<?php

namespace App\Http\Controllers;

use App\Models\InventarioSucursalLote;
use Illuminate\Http\Request;

class InventarioSucursalLoteController extends Controller
{
    public function index()
    {
        $inventario_sucursal_por_lotes = InventarioSucursalLote::with('lote.producto')->get();
        return view('admin.inventario_por_lotes.index', compact('inventario_sucursal_por_lotes'));
    }
}
