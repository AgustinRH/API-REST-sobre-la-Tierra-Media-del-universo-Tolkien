<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Realm
 * 
 * Representa un reino dentro del mundo de la aplicación.
 * Un reino pertenece a una región, contiene múltiples héroes y puede ser el origen de artefactos.
 * 
 * Relaciones:
 * - belongsTo Region: Un reino pertenece a una región
 * - hasMany Hero: Un reino tiene muchos héroes
 * - hasMany Artifact: Un reino puede ser el reino de origen de múltiples artefactos
 */
class Realm extends Model
{
    /**
     * Los atributos que se pueden asignar en masa.
     * 
     * @var array
     */
    protected $fillable = ['name', 'ruler', 'alignment', 'region_id'];
    
    /**
     * Obtiene la región a la que pertenece este reino.
     * Relación N:1 - Muchos reinos pertenecen a una región.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region() {
        return $this->belongsTo(Region::class);
    }

    /**
     * Obtiene todos los héroes que pertenecen a este reino.
     * Relación 1:N - Un reino tiene muchos héroes.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function heroes() {
        return $this->hasMany(Hero::class);
    }

    /**
     * Obtiene los artefactos que originaron en este reino.
     * Relación 1:N - Un reino puede ser el origen de múltiples artefactos.
     * Usa la clave foránea personalizada 'origin_realm_id'.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function artifacts() {
        return $this->hasMany(Artifact::class, 'origin_realm_id');
    }
}
