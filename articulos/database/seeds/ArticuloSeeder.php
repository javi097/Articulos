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
            'nombre'=>'robot aspirador',
            'categoria'=>'electronica',
            'precio'=>'455',
            'stock'=>'3'
        ]);
        Articulo::create([
            'nombre'=>'smartphone',
            'categoria'=>'electronica',
            'precio'=>'250',
            'stock'=>'2'
        ]);
        Articulo::create([
            'nombre'=>'cortauñas',
            'categoria'=>'hogar',
            'precio'=>'2',
            'stock'=>'15'
        ]);
        Articulo::create([
            'nombre'=>'rotulador',
            'categoria'=>'bazar',
            'precio'=>'1',
            'stock'=>'12'
        ]);
        Articulo::create([
            'nombre'=>'peluche',
            'categoria'=>'bazar',
            'precio'=>'6',
            'stock'=>'6'
        ]);
        Articulo::create([
            'nombre'=>'platos',
            'categoria'=>'hogar',
            'precio'=>'5',
            'stock'=>'8'
        ]);
        Articulo::create([
            'nombre'=>'smartwatch',
            'categoria'=>'electronica',
            'precio'=>'400',
            'stock'=>''
        ]);
        Articulo::create([
            'nombre'=>'servilleteros',
            'categoria'=>'hogar',
            'precio'=>'4',
            'stock'=>'3'
        ]);
        Articulo::create([
            'nombre'=>'auriculares',
            'categoria'=>'electronica',
            'precio'=>'14',
            'stock'=>'6'
        ]);
        Articulo::create([
            'nombre'=>'mochila',
            'categoria'=>'bazar',
            'precio'=>'34',
            'stock'=>'4'
        ]);
    }
}
