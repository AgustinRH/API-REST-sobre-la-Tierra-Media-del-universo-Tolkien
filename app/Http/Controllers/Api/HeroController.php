<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    public function index() 
    {
        return response()->json(Hero::all());
    }

    public function store(Request $request) 
    {
        $hero = Hero::create($request->all());
        return response()->json($hero, 201);
    }

    public function show($id) 
    {
        $hero = Hero::with(['realm', 'artifacts'])->findOrFail($id);
        return response()->json($hero);
    }

    public function update(Request $request, string $id) 
    {
        $hero = Hero::findOrFail($id);
        $hero->update($request->all());
        return response()->json($hero, 200);
    }

    public function destroy(string $id) 
    {
        Hero::destroy($id);
        return response()->json(null, 204);
    }

    // Método para asignar un artefacto a un héroe
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

    // Método para retirar un artefacto de un héroe
    public function removeArtifact(Request $request)
    {
        $hero = Hero::findOrFail($request->hero_id);
        $hero->artifacts()->detach($request->artifact_id);

        return response()->json(['message' => 'Artefacto retirado del héroe']);
    }

    // Endpoint adicional: listar artefactos de un héroe específico
    public function getHeroArtifacts($id)
    {
        $hero = Hero::findOrFail($id);
        return response()->json($hero->artifacts);
    }

    // Endpoint adicional: listar héroes vivos
    public function getAlive()
    {
        return response()->json(Hero::where('alive', true)->get());
    }
}