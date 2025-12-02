<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([[
            'title' => 'Liga de cohetes',
            'subtitle' => 'El juego de fútbol más explosivo del universo',
            'type' => 'juego',
            'imageRoute' => 'images/banner-liga-de-cohetes.png',
            'imageDescription' => 'Banner de la Liga de Cohetes',
            'content' => 'Conduce coches supersónicos, anota goles increíbles y domina el campo en este deporte futurista que combina velocidad, estrategia y pura adrenalina.',
            'price' => 2000000
        ],[
            'title' => 'Plus de cohetes',
            'subtitle' => 'Complementos adicionales para el juego',
            'type' => 'complemento',
            'imageRoute' => 'images/cosmetics.jpg',
            'imageDescription' => 'Banner de plus de cohetes',
            'content' => 'Consigue accesorios exclusivos para quedar como un chad',
            'price' => 500000
        ]]);
    }
}
