<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;

class SucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sucursales = Sucursal::all();
        return view("admin.sucursales.index", compact("sucursales"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sucursales.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return response()->json(request()->all());
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required',
            'telefono' => 'required',
            'activa' => 'required|boolean',
        ]);

        $sucursal = new Sucursal();
        $sucursal->nombre = $request->nombre;
        $sucursal->direccion = $request->direccion;
        $sucursal->telefono = $request->telefono;
        $sucursal->activa = $request->activa;
        $sucursal->save();

        return redirect()->route('sucursales.index')
        ->with('mensaje','Sucursal Creada Exitosamente')
        ->with('icono','success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sucursal = Sucursal::findOrFail($id);
        return view('admin.sucursales.show', compact('sucursal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $sucursal = Sucursal::findOrFail($id);
        return view('admin.sucursales.edit', compact('sucursal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //return response()->json(request()->all());
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required',
            'telefono' => 'required',
            'activa' => 'required|boolean',
        ]);

        $sucursal = Sucursal::findOrFail($id);
        $sucursal->nombre = $request->nombre;
        $sucursal->direccion = $request->direccion;
        $sucursal->telefono = $request->telefono;
        $sucursal->activa = $request->activa;
        $sucursal->save();

        return redirect()->route('sucursales.index')
        ->with('mensaje','Sucursal Actualizada Exitosamente')
        ->with('icono','success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sucursal = Sucursal::findOrFail($id);
        $sucursal->delete();

        return redirect()->route('sucursales.index')
        ->with('mensaje','Sucursal Eliminada Exitosamente')
        ->with('icono','success');
    }
}
