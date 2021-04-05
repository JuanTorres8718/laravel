<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Firma extends Model
{
    use HasFactory;
    protected $fillable=[

        'id', 'imagen_firma', 'lista_chequeo_id', 'instructor_id', 'observaciones', 'estado'

    ];
}
