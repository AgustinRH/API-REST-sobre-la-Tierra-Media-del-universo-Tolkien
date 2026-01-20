<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtifactHeroSeeder extends Seeder {
    public function run() {
        DB::table('artifact_hero')->insert([
        ['artifact_id' => 1, 'hero_id' => 4], // Frodo - Anillo Único
        ['artifact_id' => 2, 'hero_id' => 1], // Aragorn - Andúril
        ['artifact_id' => 4, 'hero_id' => 5], // Galadriel - Nenya
        ['artifact_id' => 6, 'hero_id' => 4], // Frodo - Dardo
        ['artifact_id' => 5, 'hero_id' => 7], // Saruman - Palantir
    ]);
    }
}