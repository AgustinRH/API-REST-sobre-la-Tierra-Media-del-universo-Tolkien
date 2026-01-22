<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Creature;
use Illuminate\Http\Request;

/**
 * CreatureController
 * 
 * Controla los endpoints CRUD para las criaturas del mundo.
 * Maneja las operaciones: listar, crear, mostrar, actualizar y eliminar criaturas.
 * Incluye un endpoint adicional para listar criaturas peligrosas (por nivel de amenaza).
 */
class CreatureController extends Controller
{
    /**
     * Listar todas las criaturas (GET /api/creatures)
     * 
     * Retorna un array JSON con todas las criaturas almacenadas en la base de datos.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() 
    {
        return response()->json(Creature::all());
    }

    /**
     * Crear una nueva criatura (POST /api/creatures)
     * 
     * Recibe los datos de la criatura en el cuerpo de la solicitud y la almacena en la base de datos.
     * Retorna la criatura creada con código HTTP 201 (Created).
     * 
     * @param Request $request Contiene los datos de la criatura (ej: name, species, threat_level, region_id)
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) 
    {
        $creature = Creature::create($request->all());
        return response()->json($creature, 201);
    }

    /**
     * Mostrar una criatura específica (GET /api/creatures/{id})
     * 
     * Busca y retorna los detalles de una criatura por su ID, incluyendo:
     * - Su región asociada (relación belongsTo)
     * Si no existe, lanza una excepción ModelNotFoundException (404).
     * 
     * @param string $id El ID de la criatura a mostrar
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id) 
    {
        $creature = Creature::with('region')->findOrFail($id);
        return response()->json($creature);
    }

    /**
     * Actualizar una criatura existente (PUT/PATCH /api/creatures/{id})
     * 
     * Busca la criatura por ID y actualiza sus datos con los valores proporcionados.
     * Retorna la criatura actualizada.
     * 
     * @param Request $request Contiene los datos actualizados
     * @param string $id El ID de la criatura a actualizar
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id) 
    {
        $creature = Creature::findOrFail($id);
        $creature->update($request->all());
        return response()->json($creature, 200);
    }

    /**
     * Eliminar una criatura (DELETE /api/creatures/{id})
     * 
     * Busca y elimina la criatura especificada por su ID.
     * Retorna una respuesta vacía con código HTTP 204 (No Content).
     * 
     * @param string $id El ID de la criatura a eliminar
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id) 
    {
        Creature::destroy($id);
        return response()->json(null, 204);
    }

    /**
     * Listar criaturas peligrosas (GET /api/creatures/dangerous?level=8)
     * 
     * Endpoint adicional que retorna todas las criaturas con un nivel de amenaza mayor o igual
     * al valor especificado (por defecto 8).
     * Útil para obtener las criaturas más peligrosas del mundo.
     * 
     * @param Request $request Parámetro query 'level' (por defecto 8)
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDangerous(Request $request)
    {
        $level = $request->query('level', 8);
        $creatures = Creature::where('threat_level', '>=', $level)->get();
        
        return response()->json($creatures);
    }
}