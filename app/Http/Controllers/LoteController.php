<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoteController extends Controller
{
    public function index(Request $request)
    {
        $fecha_desde = $request->input('fecha_desde');
        $fecha_hasta = $request->input('fecha_hasta');

        //return response()->json($request->all());
        $lotes = Lote::with('producto', 'proveedor')->get();

        if ($fecha_desde && $fecha_hasta) {
            $lotes = Lote::with('producto', 'proveedor')
                ->whereBetween('fecha_vencimiento', [$fecha_desde, $fecha_hasta])
                ->get();
        }

        $lotes->each(function ($lote) {
            $fecha_vencimiento = Carbon::parse($lote->fecha_vencimiento);
            $hoy = Carbon::today();
            $lote->is_expired = $fecha_vencimiento->isPast();
            $lote->days_to_expire = $hoy->diffInDays($fecha_vencimiento, false);
        });


        return view('admin.lotes.index', compact('lotes'));
    }
}
