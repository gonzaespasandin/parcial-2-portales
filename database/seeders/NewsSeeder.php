<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('news')->insert([[
            'title' => 'Temporada 20: “Turbo al Infinito”',
            'content' => 'A partir del 10 de octubre, los jugadores podrán disfrutar de la nueva temporada “Turbo al Infinito”, que trae consigo dos nuevas arenas: Ciudad Neón y Volcán Alfa. Además, se incorporan nuevos autos personalizables con efectos de propulsión que dejarán una estela de humo con olor a victoria (y a goma quemada). El Pase de Temporada incluirá más de 100 niveles de recompensas, desde calcomanías reactivas hasta explosiones temáticas de confeti. ¡Prepará tus motores, porque esta temporada va a despegar literalmente!',
            //'image' => 'imagen1.jpg',
            //'image_description' => 'Descripción de la imagen 1',
            //'user_id' => 1,
            'category_fk_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'title' => 'La velocidad del erizo azul llega oficialmente a la Liga de Cohetes.',
            'content' => 'En una colaboración inesperada con SEGA, Sonic the Hedgehog se une a la Liga de Cohetes para celebrar su aniversario número 35. Durante el evento “Ruedas Supersónicas”, los jugadores podrán desbloquear autos inspirados en Sonic, Tails y Knuckles, además de un modo temporal llamado “Anillos Turbo”, donde recolectar anillos aumenta tu velocidad máxima. El evento estará disponible del 15 al 30 de octubre, e incluirá desafíos especiales, música de Sonic remixada y explosiones con forma de anillo dorado. ¡No frenes, que la meta está más cerca que nunca!',
            //'image' => 'imagen2.jpg',
            //'image_description' => 'Descripción de la imagen 2',
            //'user_id' => 1,
            'category_fk_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ], [
            'title' => 'Los motores rugen también en el mundo competitivo: llega el primer torneo nacional oficial.',
            'content' => 'La Rocket League Argentina Cup reunirá a los 32 mejores equipos del país, con enfrentamientos semanales transmitidos en vivo por Twitch y YouTube. El torneo ofrecerá premios en efectivo, merchandising exclusivo y un trofeo impreso en 3D, cortesía del estudio desarrollador. El equipo ganador representará a Argentina en la Copa Latinoamericana de Cohetes 2025. Si tenés reflejos rápidos, nervios de acero y una conexión medianamente estable, ¡es tu momento de despegar hacia la gloria!',
            //'image' => 'imagen3.jpg',
            //'image_description' => 'Descripción de la imagen 3',
            //'user_id' => 1,
            'category_fk_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]]);
        
    }
}
