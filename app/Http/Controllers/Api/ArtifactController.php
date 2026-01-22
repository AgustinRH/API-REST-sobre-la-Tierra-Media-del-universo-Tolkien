<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artifact;
use Illuminate\Http\Request;

/**
 * ArtifactController
 * 
 * Controla los endpoints CRUD para los artefactos del mundo.
 * Maneja las operaciones: listar, crear, mostrar, actualizar y eliminar artefactos.
 * Incluye endpoints adicionales para:
 * - Listar artefactos de alto poder (power_level > 90)
 * - Listar héroes que poseen un artefacto específico
 */
class ArtifactController extends Controller
{
    /**
     * Listar todos los artefactos (GET /api/artifacts)
     * 
     * Retorna un array JSON con todos los artefactos almacenados en la base de datos.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() 
    {
        return response()->json(Artifact::all());
    }

    /**
     * Crear un nuevo artefacto (POST /api/artifacts)
     * 
     * Recibe los datos del artefacto en el cuerpo de la solicitud y lo almacena en la base de datos.
     * Retorna el artefacto creado con código HTTP 201 (Created).
     * 
     * @param Request $request Contiene los datos del artefacto (ej: name, type, origin_realm_id, power_level, description)
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) 
    {
        $artifact = Artifact::create($request->all());
        return response()->json($artifact, 201);
    }

    /**
     * Mostrar un artefacto específico (GET /api/artifacts/{id})
     * 
     * Busca y retorna los detalles de un artefacto por su ID, incluyendo:
     * - Su reino de origen (relación belongsTo)
     * - Sus héroes asociados (relación belongsToMany)
     * Si no existe, lanza una excepción ModelNotFoundException (404).
     * 
     * @param string $id El ID del artefacto a mostrar
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id) 
    {
        $artifact = Artifact::with(['originRealm', 'heroes'])->findOrFail($id);
        return response()->json($artifact);
    }

    /**
     * Actualizar un artefacto existente (PUT/PATCH /api/artifacts/{id})
     * 
     * Busca el artefacto por ID y actualiza sus datos con los valores proporcionados.
     * Retorna el artefacto actualizado.
     * 
     * @param Request $request Contiene los datos actualizados
     * @param string $id El ID del artefacto a actualizar
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id) 
    {
        $artifact = Artifact::findOrFail($id);
        $artifact->update($request->all());
        return response()->json($artifact, 200);
    }

    /**
     * Eliminar un artefacto (DELETE /api/artifacts/{id})
     * 
     * Busca y elimina el artefacto especificado por su ID.
     * Retorna una respuesta vacía con código HTTP 204 (No Content).
     * 
     * @param string $id El ID del artefacto a eliminar
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id) 
    {
        Artifact::destroy($id);
        return response()->json(null, 204);
    }

    /**
     * Listar artefactos de alto poder (GET /api/artifacts/top)
     * 
     * Endpoint adicional que retorna todos los artefactos con un nivel de poder mayor a 90.
     * Útil para obtener los artefactos más poderosos del mundo.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTop()
    {
        $topArtifacts = Artifact::where('power_level', '>', 90)->get();
        return response()->json($topArtifacts);
    }

    /**
     * Listar héroes que poseen un artefacto específico (GET /api/artifacts/{id}/heroes)
     * 
     * Endpoint adicional que retorna todos los héroes que poseen un artefacto en particular.
     * Útil para saber cuál es el alcance de un artefacto específico.
     * 
     * @param mixed $id El ID del artefacto
     * @return \Illuminate\Http\JsonResponse
     */
    public function getArtifactHeroes($id)
    {
        $artifact = Artifact::findOrFail($id);
        return response()->json($artifact->heroes);
    }
}