<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{RegionController, RealmController, HeroController, CreatureController, ArtifactController};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Este archivo define todas las rutas de la API REST del sistema.
| Las rutas están organizadas en tres categorías principales:
| 1. Endpoints especiales (filtrados, búsquedas específicas)
| 2. Endpoints para gestionar relaciones N:N
| 3. Endpoints CRUD estándar (RESTful)
|--------------------------------------------------------------------------
*/

/**
 * GRUPO 1: ENDPOINTS ESPECIALES Y FILTRADOS
 * 
 * Estos endpoints proporcionan funcionalidades específicas más allá del CRUD estándar.
 * Permiten filtrar y obtener datos específicos del sistema.
 */

// Obtener todos los héroes que están vivos (alive = true)
// GET /api/heroes/alive
Route::get('heroes/alive', [HeroController::class, 'getAlive']);

// Obtener criaturas peligrosas (threat_level >= nivel especificado)
// GET /api/creatures/dangerous?level=8
Route::get('creatures/dangerous', [CreatureController::class, 'getDangerous']);

// Obtener artefactos de poder superior (power_level > 90)
// GET /api/artifacts/top
Route::get('artifacts/top', [ArtifactController::class, 'getTop']);

/**
 * GRUPO 2: ENDPOINTS PARA GESTIONAR RELACIONES N:N
 * 
 * Estos endpoints permiten asignar y remover artefactos de héroes.
 * Manejan la tabla pivote 'artifact_hero' para la relación many-to-many.
 */

// Asignar un artefacto a un héroe
// POST /api/artifact-hero
// Cuerpo: { "hero_id": 1, "artifact_id": 2 }
Route::post('artifact-hero', [HeroController::class, 'assignArtifact']);

// Remover un artefacto de un héroe
// DELETE /api/artifact-hero
// Cuerpo: { "hero_id": 1, "artifact_id": 2 }
Route::delete('artifact-hero', [HeroController::class, 'removeArtifact']);

/**
 * GRUPO 3: ENDPOINTS ADICIONALES PARA RELACIONES
 * 
 * Estos endpoints permiten explorar relaciones específicas entre entidades.
 * Son alternativas a usar eager loading en los endpoints CRUD estándar.
 */

// Obtener todos los héroes que pertenecen a un reino específico
// GET /api/realms/{id}/heroes
Route::get('realms/{id}/heroes', [RealmController::class, 'getHeroes']);

// Obtener todos los artefactos de un héroe específico
// GET /api/heroes/{id}/artifacts
Route::get('heroes/{id}/artifacts', [HeroController::class, 'getHeroArtifacts']);

// Obtener todos los héroes que poseen un artefacto específico
// GET /api/artifacts/{id}/heroes
Route::get('artifacts/{id}/heroes', [ArtifactController::class, 'getArtifactHeroes']);

/**
 * GRUPO 4: RUTAS RESOURCE PARA CRUD ESTÁNDAR
 * 
 * Rutas RESTful automáticas que generan los siguientes endpoints:
 * - GET    /api/{resource}              (index)    - Listar todos
 * - POST   /api/{resource}              (store)    - Crear nuevo
 * - GET    /api/{resource}/{id}         (show)     - Mostrar uno
 * - PUT    /api/{resource}/{id}         (update)   - Actualizar
 * - DELETE /api/{resource}/{id}         (destroy)  - Eliminar
 */

// Rutas CRUD para Regions (Regiones)
Route::apiResource('regions', RegionController::class);

// Rutas CRUD para Realms (Reinos)
Route::apiResource('realms', RealmController::class);

// Rutas CRUD para Heroes (Héroes)
Route::apiResource('heroes', HeroController::class);

// Rutas CRUD para Creatures (Criaturas)
Route::apiResource('creatures', CreatureController::class);

// Rutas CRUD para Artifacts (Artefactos)
Route::apiResource('artifacts', ArtifactController::class);