<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Realm;
use Illuminate\Http\Request;

/**
 * RealmController
 * 
 * Controla los endpoints CRUD para los reinos del mundo.
 * Maneja las operaciones: listar, crear, mostrar, actualizar y eliminar reinos.
 * Incluye un endpoint adicional para listar los héroes de un reino específico.
 */
class RealmController extends Controller
{
    /**
     * Listar todos los reinos (GET /api/realms)
     * 
     * Retorna un array JSON con todos los reinos almacenados en la base de datos.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() 
    {
        return response()->json(Realm::all());
    }

    /**
     * Crear un nuevo reino (POST /api/realms)
     * 
     * Recibe los datos del reino en el cuerpo de la solicitud y lo almacena en la base de datos.
     * Retorna el reino creado con código HTTP 201 (Created).
     * 
     * @param Request $request Contiene los datos del reino (ej: name, ruler, alignment, region_id)
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) 
    {
        $realm = Realm::create($request->all());
        return response()->json($realm, 201);
    }

    /**
     * Mostrar un reino específico (GET /api/realms/{id})
     * 
     * Busca y retorna los detalles de un reino por su ID, incluyendo:
     * - Su región asociada (relación belongsTo)
     * - Sus héroes (relación hasMany)
     * - Sus artefactos (relación hasMany)
     * Si no existe, lanza una excepción ModelNotFoundException (404).
     * 
     * @param string $id El ID del reino a mostrar
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id) 
    {
        $realm = Realm::with(['region', 'heroes', 'artifacts'])->findOrFail($id);
        return response()->json($realm);
    }

    /**
     * Actualizar un reino existente (PUT/PATCH /api/realms/{id})
     * 
     * Busca el reino por ID y actualiza sus datos con los valores proporcionados.
     * Retorna el reino actualizado.
     * 
     * @param Request $request Contiene los datos actualizados
     * @param string $id El ID del reino a actualizar
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id) 
    {
        $realm = Realm::findOrFail($id);
        $realm->update($request->all());
        return response()->json($realm, 200);
    }

    /**
     * Eliminar un reino (DELETE /api/realms/{id})
     * 
     * Busca y elimina el reino especificado por su ID.
     * Retorna una respuesta vacía con código HTTP 204 (No Content).
     * 
     * @param string $id El ID del reino a eliminar
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id) 
    {
        Realm::destroy($id);
        return response()->json(null, 204);
    }

    /**
     * Listar todos los héroes de un reino específico (GET /api/realms/{id}/heroes)
     * 
     * Endpoint adicional que retorna todos los héroes que pertenecen a un reino en particular.
     * Útil para obtener los héroes de un reino sin cargar todos sus otros datos.
     * 
     * @param string $id El ID del reino
     * @return \Illuminate\Http\JsonResponse
     */
    public function getHeroes(string $id)
    {
        $realm = Realm::findOrFail($id);
        return response()->json($realm->heroes);
    }
}