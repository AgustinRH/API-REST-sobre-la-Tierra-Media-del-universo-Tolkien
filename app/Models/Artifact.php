<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Artifact
 * 
 * Representa un artefacto mágico del mundo que puede ser poseído por héroes.
 * Cada artefacto tiene un reino de origen y puede ser poseído por múltiples héroes.
 * 
 * Relaciones:
 * - belongsTo Realm: Un artefacto pertenece a un reino de origen
 * - belongsToMany Hero: Un artefacto puede ser poseído por muchos héroes (relación N:N)
 */
class Artifact extends Model
{
    /**
     * Los atributos que se pueden asignar en masa.
     * 
     * @var array
     */
    protected $fillable = ['name', 'type', 'origin_realm_id', 'power_level', 'description'];
    
    /**
     * Obtiene el reino de origen de este artefacto.
     * Relación N:1 - Muchos artefactos pueden originarse en un reino.
     * Usa la clave foránea personalizada 'origin_realm_id'.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function originRealm() {
        return $this->belongsTo(Realm::class, 'origin_realm_id');
    }

    /**
     * Obtiene los héroes que poseen este artefacto.
     * Relación N:N - Un artefacto puede ser poseído por muchos héroes y un héroe puede poseer muchos artefactos.
     * Usa la tabla pivote 'artifact_hero' para almacenar la relación.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function heroes() {
        return $this->belongsToMany(Hero::class, 'artifact_hero');
    }
}
