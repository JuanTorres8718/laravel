<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Competencia;

class Competencias extends Component
{
    public function render()
    {
        $comp = Competencia::all();
        return view('livewire.competencias');
    }
}
