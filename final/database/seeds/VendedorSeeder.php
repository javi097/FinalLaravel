<?php

use App\Vendedor;
use Illuminate\Database\Seeder;

class VendedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vendedor::create([
            'nombre'=>'Javier',
            'apellidos'=>'Lopez Fernandez'
        ]);
        Vendedor::create([
            'nombre'=>'Ruben',
            'apellidos'=>'Garcia De Sousa'
        ]);
        Vendedor::create([
            'nombre'=>'Juanfran',
            'apellidos'=>'Alarcon Muñoz'
        ]);
        Vendedor::create([
            'nombre'=>'Manuel',
            'apellidos'=>'Pastor Jimenez'
        ]);
    }
}
