<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HeroesSeeder extends Seeder {
    public function run() {
        DB::table('heroes')->insert([
        ['name' => 'Aragorn', 'race' => 'Humano', 'rank' => 'Rey', 'realm_id' => 1, 'alive' => true],
        ['name' => 'Legolas', 'race' => 'Elfo', 'rank' => 'Príncipe', 'realm_id' => 5, 'alive' => true],
        ['name' => 'Gimli', 'race' => 'Enano', 'rank' => 'Señor de las Cavernas', 'realm_id' => 4, 'alive' => true],
        ['name' => 'Frodo Bolsón', 'race' => 'Hobbit', 'rank' => 'Portador del Anillo', 'realm_id' => 6, 'alive' => true],
        ['name' => 'Galadriel', 'race' => 'Elfo', 'rank' => 'Dama de la Luz', 'realm_id' => 5, 'alive' => true],
        ['name' => 'Éowyn', 'race' => 'Humano', 'rank' => 'Escudera', 'realm_id' => 2, 'alive' => true],
        ['name' => 'Saruman', 'race' => 'Istari', 'rank' => 'Mago Blanco', 'realm_id' => 7, 'alive' => false],
        ['name' => 'Boromir', 'race' => 'Humano', 'rank' => 'Capitán Blanco', 'realm_id' => 1, 'alive' => false],
    ]);
    }
}