<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([[
            'id' => 1,
            'name' => 'Actualizaciones',
            'color' => '#4f77b8',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'id' => 2,
            'name' => 'Colaboraciones',
            'color' => '#e39612',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'id' => 3,
            'name' => 'Comunidad',
            'color' => '#29a329',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'id' => 4,
            'name' => 'Eventos',
            'color' => '#a32929',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'id' => 5,
            'name' => 'Noticias',
            'color' => '#6d3bd1',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'id' => 6,
            'name' => 'Otros',
            'color' => '#1a1919',
            'created_at' => now(),
            'updated_at' => now(),
        ]
    ]);
        
    }
}
