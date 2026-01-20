<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    protected $fillable = ['name', 'race', 'rank', 'realm_id', 'alive'];
    
    protected $casts = [
        'alive' => 'boolean',
    ];
    
    public function realm() {
        return $this->belongsTo(Realm::class);
    }

    public function artifacts() {
        return $this->belongsToMany(Artifact::class, 'artifact_hero');
    }
}
