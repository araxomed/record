<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poblacion extends Model
{
    use HasFactory;
    protected $table = 'poblacion';
    protected $fillable = ['numdoc', 'name', 'area', 'formulario_id', 'user_id'];
    public $timestamps = false;

}
