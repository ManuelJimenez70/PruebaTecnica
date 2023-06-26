<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mueble_Material extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "mueble_id",
        "material_id",
        "cantidad",
    ];

    public function material(){
        return $this->hasMany(Material::class);
    }

    public function mueble(){
        return $this->hasMany(Mueble::class);
    }
}
