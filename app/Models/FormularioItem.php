<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormularioItem extends Model
{
    use HasFactory;
    protected $table = 'formularios_items';
    public $timestamps = false;

    public function formulario()
    {
        return $this->belongsTo(Formulario::class, 'formulario_id');
    }

    public function datas()
    {
        return $this->hasMany(FormularioData::class, 'item_id');
    }

}
