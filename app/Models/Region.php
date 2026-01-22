<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Region
 * 
 * Representa una región geográfica del mundo que puede contener múltiples reinos y criaturas.
 * Una región tiene una relación 1:N con Realm (un reino pertenece a una región)
 * y una relación 1:N con Creature (una criatura pertenece a una región).
 */
class Region extends Model
{
    /**
     * Los atributos que se pueden asignar en masa.
     * 
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Obtiene los reinos que pertenecen a esta región.
     * Relación 1:N - Una región tiene muchos reinos.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function realms() {
        return $this->hasMany(Realm::class);
    }

    /**
     * Obtiene las criaturas que habitan en esta región.
     * Relación 1:N - Una región tiene muchas criaturas.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function creatures() {
        return $this->hasMany(Creature::class);
    }
}
