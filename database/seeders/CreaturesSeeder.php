<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreaturesSeeder extends Seeder {
    public function run() {
        DB::table('creatures')->insert([
        ['name' => 'Balrog de Moria', 'species' => 'Maia Corrupto', 'threat_level' => 10, 'region_id' => 2],
        ['name' => 'Ella-Laraña', 'species' => 'Araña Gigante', 'threat_level' => 9, 'region_id' => 3],
        ['name' => 'Rey Brujo de Angmar', 'species' => 'Nazgûl', 'threat_level' => 10, 'region_id' => 3],
        ['name' => 'Bárbol', 'species' => 'Ent', 'threat_level' => 8, 'region_id' => 2],
        ['name' => 'Huargo', 'species' => 'Bestia', 'threat_level' => 5, 'region_id' => 5],
        ['name' => 'Orco de Mordor', 'species' => 'Orco', 'threat_level' => 3, 'region_id' => 3],
    ]);
    }
}