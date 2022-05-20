<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormularioData extends Model
{
    use HasFactory;
    protected $table = 'formularios_data';
    public $timestamps = false;

    public function response()
    {
        return $this->belongsTo(FormularioResponse::class, 'response_id');
    }

    public function item()
    {
        return $this->belongsTo(FormularioItem::class, 'item_id');
    }

}
