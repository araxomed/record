<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    use HasFactory;
    protected $table = 'formularios';

    public function tema()
    {
        return $this->belongsTo(Tema::class, 'tema_id');
    }

    public function items()
    {
        return $this->hasMany(FormularioItem::class, 'formulario_id');
    }

    public function responses()
    {
        return $this->hasMany(FormularioResponse::class, 'formulario_id');
    }

}
