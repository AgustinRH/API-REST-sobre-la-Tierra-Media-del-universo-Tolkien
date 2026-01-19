<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artifact extends Model
{
    protected $fillable = ['name', 'type', 'origin_realm_id', 'power_level', 'description'];
    
    public function originRealm() {
        return $this->belongsTo(Realm::class, 'origin_realm_id');
    }

    public function heroes() {
        return $this->belongsToMany(Hero::class, 'artifact_hero');
    }
}
