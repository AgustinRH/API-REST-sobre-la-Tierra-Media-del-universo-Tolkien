<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Hero
 * 
 * Representa un héroe del mundo. Los héroes pertenecen a un reino y pueden poseer múltiples artefactos.
 * 
 * Relaciones:
 * - belongsTo Realm: Un héroe pertenece a un reino
 * - belongsToMany Artifact: Un héroe puede tener muchos artefactos (relación N:N)
 */
class Hero extends Model
{
    /**
     * Los atributos que se pueden asignar en masa.
     * 
     * @var array
     */
    protected $fillable = ['name', 'race', 'rank', 'realm_id', 'alive'];
    
    /**
     * Define los tipos de atributos que deben castearse.
     * El campo 'alive' se convierte automáticamente a booleano.
     * 
     * @var array
     */
    protected $casts = [
        'alive' => 'boolean',
    ];
    
    /**
     * Obtiene el reino al que pertenece este héroe.
     * Relación N:1 - Muchos héroes pertenecen a un reino.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function realm() {
        return $this->belongsTo(Realm::class);
    }

    /**
     * Obtiene los artefactos que posee este héroe.
     * Relación N:N - Un héroe puede tener muchos artefactos y un artefacto puede ser poseído por muchos héroes.
     * Usa la tabla pivote 'artifact_hero' para almacenar la relación.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function artifacts() {
        return $this->belongsToMany(Artifact::class, 'artifact_hero');
    }
}
