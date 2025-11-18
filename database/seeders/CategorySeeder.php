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
            'category_id' => 1,
            'category_name' => 'Actualizaciones',
            'color' => '#4f77b8',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'category_id' => 2,
            'category_name' => 'Colaboraciones',
            'color' => '#e39612',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'category_id' => 3,
            'category_name' => 'Comunidad',
            'color' => '#29a329',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'category_id' => 4,
            'category_name' => 'Eventos',
            'color' => '#a32929',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'category_id' => 5,
            'category_name' => 'Noticias',
            'color' => '#6d3bd1',
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'category_id' => 6,
            'category_name' => 'Otros',
            'color' => '#1a1919',
            'created_at' => now(),
            'updated_at' => now(),
        ]
    ]);
        
    }
}
