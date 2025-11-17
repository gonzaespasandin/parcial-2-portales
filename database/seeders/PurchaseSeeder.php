<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('purchases')->insert([[
            'user_id' => 2,
            'product_id_fk' => 1,
            'payment_method' => 'transfer',
            'purchased_at' => now(),
        ],[
            'user_id' => 2,
            'product_id_fk' => 2,
            'payment_method' => 'mercado_pago',
            'purchased_at' => now(),
        ], [
            'user_id' => 3,
            'product_id_fk' => 1,
            'payment_method' => 'credit_card',
            'purchased_at' => now(),
        ]]);
    }
}
