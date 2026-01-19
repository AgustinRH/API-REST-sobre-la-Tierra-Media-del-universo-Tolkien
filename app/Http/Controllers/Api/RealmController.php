<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Realm;
use Illuminate\Http\Request;

class RealmController extends Controller
{
    public function index() 
    {
        return response()->json(Realm::all());
    }

    public function store(Request $request) 
    {
        $realm = Realm::create($request->all());
        return response()->json($realm, 201);
    }

    /**
     * Muestra detalles de un reino, incluyendo región, héroes y artefactos.
     */
    public function show(string $id) 
    {
        $realm = Realm::with(['region', 'heroes', 'artifacts'])->findOrFail($id);
        return response()->json($realm);
    }

    public function update(Request $request, string $id) 
    {
        $realm = Realm::findOrFail($id);
        $realm->update($request->all());
        return response()->json($realm, 200);
    }

    public function destroy(string $id) 
    {
        Realm::destroy($id);
        return response()->json(null, 204);
    }

    
    // Endpoint adicional: listar héroes de un reino específico
    public function getHeroes(string $id)
    {
        $realm = Realm::findOrFail($id);
        return response()->json($realm->heroes);
    }
}