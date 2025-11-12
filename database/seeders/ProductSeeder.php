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
            'title' => 'Liga de Cohetes',
            'subtitle' => 'El juego de fútbol más explosivo del universo',
            'imageRoute' => 'img/home/banner-liga-de-cohetes.png',
            'imageDescription' => 'Banner de la Liga de Cohetes',
            'content' => 'Conduce coches supersónicos, anota goles increíbles y domina el campo en este deporte futurista que combina velocidad, estrategia y pura adrenalina.',
            'price' => '20000'
        ],[
            'title' => 'Liga de Cohetes Plus',
            'subtitle' => 'Complementos adicionales para el juego',
            'imageRoute' => 'img/home/cosmetics.jpg',
            'imageDescription' => 'Banner de la Liga de Cohetes Plus',
            'content' => 'Consigue accesorios exclusivos para quedar como un chad',
            'price' => '5000'
        ]]);
    }
}
