<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;

/**
 * HeroController
 * 
 * Controla los endpoints CRUD para los héroes del mundo.
 * Maneja las operaciones: listar, crear, mostrar, actualizar y eliminar héroes.
 * Incluye endpoints adicionales para:
 * - Asignar y remover artefactos a/de héroes
 * - Listar artefactos de un héroe
 * - Listar todos los héroes vivos
 */
class HeroController extends Controller
{
    /**
     * Listar todos los héroes (GET /api/heroes)
     * 
     * Retorna un array JSON con todos los héroes almacenados en la base de datos.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() 
    {
        return response()->json(Hero::all());
    }

    /**
     * Crear un nuevo héroe (POST /api/heroes)
     * 
     * Recibe los datos del héroe en el cuerpo de la solicitud y lo almacena en la base de datos.
     * Retorna el héroe creado con código HTTP 201 (Created).
     * 
     * @param Request $request Contiene los datos del héroe (ej: name, race, rank, realm_id, alive)
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) 
    {
        $hero = Hero::create($request->all());
        return response()->json($hero, 201);
    }

    /**
     * Mostrar un héroe específico (GET /api/heroes/{id})
     * 
     * Busca y retorna los detalles de un héroe por su ID, incluyendo:
     * - Su reino asociado (relación belongsTo)
     * - Sus artefactos (relación belongsToMany)
     * Si no existe, lanza una excepción ModelNotFoundException (404).
     * 
     * @param mixed $id El ID del héroe a mostrar
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id) 
    {
        $hero = Hero::with(['realm', 'artifacts'])->findOrFail($id);
        return response()->json($hero);
    }

    /**
     * Actualizar un héroe existente (PUT/PATCH /api/heroes/{id})
     * 
     * Busca el héroe por ID y actualiza sus datos con los valores proporcionados.
     * Retorna el héroe actualizado.
     * 
     * @param Request $request Contiene los datos actualizados
     * @param string $id El ID del héroe a actualizar
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id) 
    {
        $hero = Hero::findOrFail($id);
        $hero->update($request->all());
        return response()->json($hero, 200);
    }

    /**
     * Eliminar un héroe (DELETE /api/heroes/{id})
     * 
     * Busca y elimina el héroe especificado por su ID.
     * Retorna una respuesta vacía con código HTTP 204 (No Content).
     * 
     * @param string $id El ID del héroe a eliminar
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id) 
    {
        Hero::destroy($id);
        return response()->json(null, 204);
    }

    /**
     * Asignar un artefacto a un héroe (POST /api/artifact-hero)
     * 
     * Crea una relación N:N entre un héroe y un artefacto.
     * Usa syncWithoutDetaching para evitar desasignar artefactos existentes.
     * 
     * Validación:
     * - hero_id: requerido, debe existir en la tabla heroes
     * - artifact_id: requerido, debe existir en la tabla artifacts
     * 
     * @param Request $request Contiene hero_id y artifact_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignArtifact(Request $request)
    {
        $request->validate([
            'hero_id' => 'required|exists:heroes,id',
            'artifact_id' => 'required|exists:artifacts,id'
        ]);

        $hero = Hero::findOrFail($request->hero_id);
        
        $hero->artifacts()->syncWithoutDetaching([$request->artifact_id]);

        return response()->json(['message' => 'Artefacto asignado al héroe']);
    }

    /**
     * Remover un artefacto de un héroe (DELETE /api/artifact-hero)
     * 
     * Elimina la relación N:N entre un héroe y un artefacto específico.
     * Usa detach para remover solo el artefacto especificado.
     * 
     * @param Request $request Contiene hero_id y artifact_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeArtifact(Request $request)
    {
        $hero = Hero::findOrFail($request->hero_id);
        $hero->artifacts()->detach($request->artifact_id);

        return response()->json(['message' => 'Artefacto retirado del héroe']);
    }

    /**
     * Listar todos los artefactos de un héroe específico (GET /api/heroes/{id}/artifacts)
     * 
     * Endpoint adicional que retorna todos los artefactos que posee un héroe en particular.
     * 
     * @param mixed $id El ID del héroe
     * @return \Illuminate\Http\JsonResponse
     */
    public function getHeroArtifacts($id)
    {
        $hero = Hero::findOrFail($id);
        return response()->json($hero->artifacts);
    }

    /**
     * Listar todos los héroes vivos (GET /api/heroes/alive)
     * 
     * Endpoint adicional que retorna únicamente los héroes que están vivos (alive = true).
     * Útil para filtrar héroes activos del mundo.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAlive()
    {
        return response()->json(Hero::where('alive', true)->get());
    }
}