<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoteController extends Controller
{
    public function index()
    {
        //return response()->json($request->all());
        $lotes = Lote::with('producto', 'proveedor')->get();

        $lotes->each(function ($lote) {
            $lote->is_expired = Carbon::parse($lote->fecha_vencimiento)->isPast();
        });


        return view('admin.lotes.index', compact('lotes'));
    }
}
