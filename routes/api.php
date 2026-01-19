<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{RegionController, RealmController, HeroController, CreatureController, ArtifactController};


// RUTAS API
Route::get('heroes/alive', [HeroController::class, 'getAlive']);
Route::get('creatures/dangerous', [CreatureController::class, 'getDangerous']);
Route::get('artifacts/top', [ArtifactController::class, 'getTop']);

// 2. RUTAS DE ASIGNACIÓN Y DESASIGNACIÓN DE RELACIONES N:N
Route::post('artifact-hero', [HeroController::class, 'assignArtifact']);
Route::delete('artifact-hero', [HeroController::class, 'removeArtifact']);

// 3. RUTAS DE ENDPOINTS ADICIONALES PARA RELACIONES N:1 Y N:N
Route::get('realms/{id}/heroes', [RealmController::class, 'getHeroes']);
Route::get('regions/{id}/creatures', [RegionController::class, 'getCreatures']); // Si lo implementas
Route::get('heroes/{id}/artifacts', [HeroController::class, 'getHeroArtifacts']);
Route::get('artifacts/{id}/heroes', [ArtifactController::class, 'getArtifactHeroes']);

// RUTAS RESOURCE PARA CRUD
Route::apiResource('regions', RegionController::class);
Route::apiResource('realms', RealmController::class);
Route::apiResource('heroes', HeroController::class);
Route::apiResource('creatures', CreatureController::class);
Route::apiResource('artifacts', ArtifactController::class);