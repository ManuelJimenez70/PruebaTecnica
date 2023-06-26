<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mueble extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'nombre',
        'description',
        'estado',
    ];

    public function materiales(){
        return $this->belongsTo(Mueble_Material::class);
    }
}
