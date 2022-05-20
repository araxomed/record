<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormularioResponse extends Model
{
    use HasFactory;
    protected $table = 'formularios_response';

    public function formulario()
    {
        return $this->belongsTo(Formulario::class, 'formulario_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function datas()
    {
        return $this->hasMany(FormularioData::class, 'response_id');
    }

}
