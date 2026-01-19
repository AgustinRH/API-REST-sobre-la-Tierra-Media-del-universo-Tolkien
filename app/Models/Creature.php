<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Creature extends Model
{
    protected $fillable = ['name', 'species', 'danger_level', 'region_id'];
    
    public function region() {
        return $this->belongsTo(Region::class);
    }
}
