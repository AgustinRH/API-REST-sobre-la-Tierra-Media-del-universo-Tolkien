<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artifact;
use Illuminate\Http\Request;

class ArtifactController extends Controller
{
    // Método para listar todos los artefactos
    public function index() 
    {
        return response()->json(Artifact::all());
    }

    // Método para crear un nuevo artefacto
    public function store(Request $request) 
    {
        $artifact = Artifact::create($request->all());
        return response()->json($artifact, 201);
    }

    // Método para mostrar un artefacto específico con su reino de origen y héroes asociados
    public function show(string $id) 
    {
        // Cargamos 'originRealm' (1:N) y 'heroes' (N:N)
        $artifact = Artifact::with(['originRealm', 'heroes'])->findOrFail($id);
        return response()->json($artifact);
    }

    // Método para actualizar un artefacto existente
    public function update(Request $request, string $id) 
    {
        $artifact = Artifact::findOrFail($id);
        $artifact->update($request->all());
        return response()->json($artifact, 200);
    }

    // Método para eliminar un artefacto
    public function destroy(string $id) 
    {
        Artifact::destroy($id);
        return response()->json(null, 204);
    }

    // Endpoint adicional: listar artefactos con nivel de poder mayor a 90
    public function getTop()
    {
        $topArtifacts = Artifact::where('power_level', '>', 90)->get();
        return response()->json($topArtifacts);
    }

    // Endpoint adicional: listar héroes que poseen un artefacto específico
    public function getArtifactHeroes($id)
    {
        $artifact = Artifact::findOrFail($id);
        return response()->json($artifact->heroes);
    }
}