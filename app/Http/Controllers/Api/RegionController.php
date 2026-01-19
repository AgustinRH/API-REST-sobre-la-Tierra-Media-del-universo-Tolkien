<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() // Listar todas las regiones
    {
        return response()->json(\App\Models\Region::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) // Crear una nueva región
    {
        $region = \App\Models\Region::create($request->all());
        return response()->json($region, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) // Mostrar una región específica
    {
        return response()->json(\App\Models\Region::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) // Actualizar una región existente
    {
        $region = \App\Models\Region::findOrFail($id);
        $region->update($request->all());
        return response()->json($region, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) // Eliminar una región
    {
        \App\Models\Region::destroy($id);
        return response()->json(null, 204);
    }
}
