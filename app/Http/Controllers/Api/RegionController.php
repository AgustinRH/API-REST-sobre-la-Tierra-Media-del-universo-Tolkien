<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * RegionController
 * 
 * Controla los endpoints CRUD para las regiones del mundo.
 * Maneja las operaciones: listar, crear, mostrar, actualizar y eliminar regiones.
 */
class RegionController extends Controller
{
    /**
     * Listar todas las regiones (GET /api/regions)
     * 
     * Retorna un array JSON con todas las regiones almacenadas en la base de datos.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(\App\Models\Region::all());
    }

    /**
     * Crear una nueva región (POST /api/regions)
     * 
     * Recibe los datos de la región en el cuerpo de la solicitud y la almacena en la base de datos.
     * Retorna la región creada con código HTTP 201 (Created).
     * 
     * @param Request $request Contiene los datos de la región (ej: name)
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $region = \App\Models\Region::create($request->all());
        return response()->json($region, 201);
    }

    /**
     * Mostrar una región específica (GET /api/regions/{id})
     * 
     * Busca y retorna los detalles de una región por su ID.
     * Si no existe, lanza una excepción ModelNotFoundException (404).
     * 
     * @param string $id El ID de la región a mostrar
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        return response()->json(\App\Models\Region::findOrFail($id));
    }

    /**
     * Actualizar una región existente (PUT/PATCH /api/regions/{id})
     * 
     * Busca la región por ID y actualiza sus datos con los valores proporcionados.
     * Retorna la región actualizada.
     * 
     * @param Request $request Contiene los datos actualizados
     * @param string $id El ID de la región a actualizar
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id)
    {
        $region = \App\Models\Region::findOrFail($id);
        $region->update($request->all());
        return response()->json($region, 200);
    }

    /**
     * Eliminar una región (DELETE /api/regions/{id})
     * 
     * Busca y elimina la región especificada por su ID.
     * Retorna una respuesta vacía con código HTTP 204 (No Content).
     * 
     * @param string $id El ID de la región a eliminar
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        \App\Models\Region::destroy($id);
        return response()->json(null, 204);
    }
}
