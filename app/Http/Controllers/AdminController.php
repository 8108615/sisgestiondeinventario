<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Sucursal;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $total_sucursales = Sucursal::count();
        $total_categorias = Categoria::count();
        $total_productos = Producto::count();
        $total_proveedores = Proveedor::count();
        return view('admin.index', compact('total_sucursales','total_categorias','total_productos','total_proveedores'));
    }
}
