<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    protected $table = 'lotes';

    protected $fillable = [
        'producto_id',
        'proveedor_id',
        'codigo_lote',
        'fecha_entrada',
        'fecha_vencimiento',
        'cantidad_inicial',
        'cantidad_actual',
        'precio_compra',
        'precio_venta',
        'estado',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function inventarioSucursalLotes()
    {
        return $this->hasMany(InventarioSucursalLote::class);
    }

    public function movimientosInventarios()
    {
        return $this->hasMany(MovimientoInventario::class);
    }

    public function detalleCompras()
    {
        return $this->hasMany(DetalleCompra::class);
    }
}
