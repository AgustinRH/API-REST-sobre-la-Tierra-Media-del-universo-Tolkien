<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtifactsSeeder extends Seeder {
    public function run() {
        DB::table('artifacts')->insert([
        ['name' => 'Anillo Único', 'type' => 'Anillo', 'origin_realm_id' => 3, 'power_level' => 100, 'description' => 'Un anillo para gobernarlos a todos.'],
        ['name' => 'Andúril', 'type' => 'Espada', 'origin_realm_id' => 1, 'power_level' => 85, 'description' => 'La Llama del Oeste.'],
        ['name' => 'Vilya', 'type' => 'Anillo', 'origin_realm_id' => 6, 'power_level' => 95, 'description' => 'El Anillo de Aire, portado por Elrond.'],
        ['name' => 'Nenya', 'type' => 'Anillo', 'origin_realm_id' => 5, 'power_level' => 92, 'description' => 'El Anillo de Agua, portado por Galadriel.'],
        ['name' => 'Palantir', 'type' => 'Piedra Vidente', 'origin_realm_id' => 7, 'power_level' => 80, 'description' => 'Piedra que permite ver a través del tiempo y espacio.'],
        ['name' => 'Dardo', 'type' => 'Daga', 'origin_realm_id' => 4, 'power_level' => 40, 'description' => 'Brilla azul cuando hay orcos cerca.'],
    ]);
    }
}