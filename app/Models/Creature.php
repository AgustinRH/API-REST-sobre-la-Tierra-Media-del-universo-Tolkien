<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Creature
 * 
 * Representa una criatura del mundo que habita en una región específica.
 * Las criaturas tienen un nivel de amenaza que indica su peligrosidad.
 * 
 * Relaciones:
 * - belongsTo Region: Una criatura pertenece a una región
 */
class Creature extends Model
{
    /**
     * Los atributos que se pueden asignar en masa.
     * 
     * @var array
     */
    protected $fillable = ['name', 'species', 'threat_level', 'region_id'];
    
    /**
     * Obtiene la región en la que habita esta criatura.
     * Relación N:1 - Muchas criaturas pertenecen a una región.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region() {
        return $this->belongsTo(Region::class);
    }
}
