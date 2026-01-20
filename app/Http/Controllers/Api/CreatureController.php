<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Creature;
use Illuminate\Http\Request;

class CreatureController extends Controller
{
    public function index() 
    {
        return response()->json(Creature::all());
    }

    public function store(Request $request) 
    {
        $creature = Creature::create($request->all());
        return response()->json($creature, 201);
    }

    // Método para mostrar una criatura específica con su región asociada
    public function show(string $id) 
    {
        $creature = Creature::with('region')->findOrFail($id);
        return response()->json($creature);
    }

    // Método para actualizar una criatura existente
    public function update(Request $request, string $id) 
    {
        $creature = Creature::findOrFail($id);
        $creature->update($request->all());
        return response()->json($creature, 200);
    }

    // Método para eliminar una criatura
    public function destroy(string $id) 
    {
        Creature::destroy($id);
        return response()->json(null, 204);
    }

    // Endpoint adicional: listar criaturas con nivel de amenaza mayor o igual a un valor dado
    public function getDangerous(Request $request)
    {
        $level = $request->query('level', 8);
        $creatures = Creature::where('threat_level', '>=', $level)->get();
        
        return response()->json($creatures);
    }
}