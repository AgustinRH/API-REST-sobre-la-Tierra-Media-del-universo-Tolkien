<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RealmsSeeder extends Seeder {
    public function run() {
    DB::table('realms')->insert([
        ['name' => 'Gondor', 'ruler' => 'Aragorn Elessar', 'alignment' => 'Bien', 'region_id' => 4],
        ['name' => 'Rohan', 'ruler' => 'Éomer', 'alignment' => 'Bien', 'region_id' => 5],
        ['name' => 'Mordor', 'ruler' => 'Sauron', 'alignment' => 'Mal', 'region_id' => 3],
        ['name' => 'Erebor', 'ruler' => 'Dáin II Pie de Hierro', 'alignment' => 'Bien', 'region_id' => 2],
        ['name' => 'Lothlórien', 'ruler' => 'Galadriel', 'alignment' => 'Bien', 'region_id' => 2],
        ['name' => 'Rivendel', 'ruler' => 'Elrond', 'alignment' => 'Bien', 'region_id' => 1],
        ['name' => 'Isengard', 'ruler' => 'Saruman', 'alignment' => 'Mal', 'region_id' => 5],
    ]);
}
}