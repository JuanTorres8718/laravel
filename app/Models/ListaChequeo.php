<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaChequeo extends Model
{
    use HasFactory;
    protected $fillable=[

        'id', 'codigo_lista','fecha', 'horario', 'instrucciones', 'estado'

    ];
}
