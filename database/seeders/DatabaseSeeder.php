<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Sucursal;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Sucursal::factory(10)->create(); //crea 10 sucursales
        Categoria::factory(50)->create(); //crea 50 categorias
        Producto::factory(200)->create(); //crea 200 productos
        Proveedor::factory(20)->create(); //crea 20 proveedores

        User::create([
            'name' => 'Erick Fernando Morales Gil',
            'email'=> 'erick@gmail.com',
            'password'=> bcrypt('12345678')
        ]);
    }
}
