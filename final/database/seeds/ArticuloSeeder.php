<?php

use Illuminate\Database\Seeder;
use App\Articulo;
use Illuminate\Support\Facades\DB;
class ArticuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Articulo::create([
            'nombre'=>'Cecotec 4090',
            'detalle'=>'Increible robot aspirador, con 14000W',
            'precio'=>'455',
            'categoria_id'=>'2'
        ]);
        Articulo::create([
            'nombre'=>'Xiaomi Redmi Note 8',
            'detalle'=>'Este xiaomi es uno de los mejores en su precio',
            'precio'=>'250',
            'categoria_id'=>'1'
        ]);
        Articulo::create([
            'nombre'=>'Libro Cuthulu',
            'detalle'=>'De los mejores libros de esta temática',
            'precio'=>'20',
            'categoria_id'=>'3'
        ]);
        Articulo::create([
            'nombre'=>'Woxter Big Bass 95',
            'detalle'=>'Grandes altavoces a un precio reducido, 30W',
            'precio'=>'35',
            'categoria_id'=>'1'
        ]);
        Articulo::create([
            'nombre'=>'Bombilla Xiaomi',
            'detalle'=>'Bombilla de la mano de Xiaomi, con tecnología Bluetooh y RGB',
            'precio'=>'15',
            'categoria_id'=>'1'
        ]);
        Articulo::create([
            'nombre'=>'Teclado Corsair K65',
            'detalle'=>'Teclado mecánico de alta gama',
            'precio'=>'120',
            'categoria_id'=>'1'
        ]);
        
    }
}
