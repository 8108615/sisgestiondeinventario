<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('home')->middleware('auth');
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('auth');


//rutas para categorias
Route::get('/admin/categorias', [App\Http\Controllers\CategoriaController::class, 'index'])->name('categorias.index')->middleware('auth');
Route::get('/admin/categorias/create', [App\Http\Controllers\CategoriaController::class, 'create'])->name('categorias.create')->middleware('auth');
Route::post('/admin/categorias/create', [App\Http\Controllers\CategoriaController::class, 'store'])->name('categorias.store')->middleware('auth');
Route::get('/admin/categoria/{id}', [App\Http\Controllers\CategoriaController::class, 'show'])->name('categorias.show')->middleware('auth');
Route::get('/admin/categoria/{id}/edit', [App\Http\Controllers\CategoriaController::class, 'edit'])->name('categorias.edit')->middleware('auth');
Route::put('/admin/categoria/{id}', [App\Http\Controllers\CategoriaController::class, 'update'])->name('categorias.update')->middleware('auth');
Route::delete('/admin/categoria/{id}', [App\Http\Controllers\CategoriaController::class, 'destroy'])->name('categorias.destroy')->middleware('auth');


//rutas para sucursales
Route::get('/admin/sucursales', [App\Http\Controllers\SucursalController::class, 'index'])->name('sucursales.index')->middleware('auth');
Route::get('/admin/sucursales/create', [App\Http\Controllers\SucursalController::class, 'create'])->name('sucursales.create')->middleware('auth');
Route::post('/admin/sucursales/create', [App\Http\Controllers\SucursalController::class, 'store'])->name('sucursales.store')->middleware('auth');
Route::get('/admin/sucursales/{id}', [App\Http\Controllers\SucursalController::class,'show'])->name('sucursales.show')->middleware('auth');
Route::get('/admin/sucursales/{id}/edit', [App\Http\Controllers\SucursalController::class,'edit'])->name('sucursales.edit')->middleware('auth');
Route::put('/admin/sucursales/{id}', [App\Http\Controllers\SucursalController::class,'update'])->name('sucursales.update')->middleware('auth');
Route::delete('/admin/sucursales/{id}', [App\Http\Controllers\SucursalController::class,'destroy'])->name('sucursales.destroy')->middleware('auth');

//rutas para productos
Route::get('/admin/productos', [App\Http\Controllers\ProductoController::class, 'index'])->name('productos.index')->middleware('auth');
Route::get('/admin/productos/create', [App\Http\Controllers\ProductoController::class, 'create'])->name('productos.create')->middleware('auth');
Route::post('/admin/productos/create', [App\Http\Controllers\ProductoController::class, 'store'])->name('productos.store')->middleware('auth');
Route::get('/admin/producto/{id}', [App\Http\Controllers\ProductoController::class,'show'])->name('productos.show')->middleware('auth');
Route::get('/admin/producto/{id}/edit', [App\Http\Controllers\ProductoController::class,'edit'])->name('productos.edit')->middleware('auth');
Route::put('/admin/producto/{id}', [App\Http\Controllers\ProductoController::class,'update'])->name('productos.update')->middleware('auth');
Route::delete('/admin/producto/{id}', [App\Http\Controllers\ProductoController::class,'destroy'])->name('productos.destroy')->middleware('auth');

//rutas para proveedores
Route::get('/admin/proveedores', [App\Http\Controllers\ProveedorController::class, 'index'])->name('proveedores.index')->middleware('auth');
Route::post('/admin/proveedor/create', [App\Http\Controllers\ProveedorController::class, 'store'])->name('proveedores.store')->middleware('auth');
Route::put('/admin/proveedor/{id}', [App\Http\Controllers\ProveedorController::class,'update'])->name('proveedores.update')->middleware('auth');
Route::delete('/admin/proveedor/{id}', [App\Http\Controllers\ProveedorController::class,'destroy'])->name('proveedores.destroy')->middleware('auth');

//rutas para compras
Route::get('/admin/compras', [App\Http\Controllers\CompraController::class, 'index'])->name('compras.index')->middleware('auth');
Route::get('/admin/compras/create', [App\Http\Controllers\CompraController::class, 'create'])->name('compras.create')->middleware('auth');
Route::post('/admin/compras/create', [App\Http\Controllers\CompraController::class, 'store'])->name('compras.store')->middleware('auth');
Route::get('/admin/compra/{id}/edit', [App\Http\Controllers\CompraController::class,'edit'])->name('compras.edit')->middleware('auth');
Route::put('/admin/compras/{id}', [App\Http\Controllers\CompraController::class,'update'])->name('compras.update')->middleware('auth');
Route::delete('/admin/compras/{id}', [App\Http\Controllers\CompraController::class,'destroy'])->name('compras.destroy')->middleware('auth');
