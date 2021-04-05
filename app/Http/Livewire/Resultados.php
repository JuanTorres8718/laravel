<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Resultado;
use App\Models\Competencia;
use Livewire\WithPagination;


class Resultados extends Component
{
   
    use WithPagination;

    public $search = '';
    public $perPage = '5';
    public $id_res, $nom_res, $ids, $co;
    public $com;
    public $cambio = "store";
    public  $activar = 'ACTIVO';
    public $desactivar = 'INACTIVO';
     

    public function updatingSearch()
    {
        $this->resetPage();
        
    }

    public function render()
    {
        $comp = Competencia::select('id','name')->get();
        return view('livewire.resultados', compact('comp'), [ 
            // 'compe'=> $this->com,
            'res' => Competencia::join("resultados","resultados.competencia_id","=","competencias.id")
            ->whereIn('estado', [$this->activar])
            ->where(function ($query){
             $query->Where('resultados.competencia_id', 'LIKE',"%{$this->search}%")
            ->orWhere('competencias.name', 'LIKE',"%{$this->search}%")
            ->orWhere('resultados.name', 'LIKE',"%{$this->search}%")
            ->orWhere('codigo_resultado', 'LIKE',"%{$this->search}%");
         
           })
           ->simplePaginate($this->perPage)
 
        ]); 
    }
    
    public function store(){

        $validatedDate = $this->validate([
            'id_res' => 'required',
            'nom_res' => 'required',
            'co' => 'required',
            
        ]);

        if($this->validarCreado() == 0){
        Resultado::create([

                'codigo_resultado' => $this->id_res,
                'name' => $this->nom_res,
                'competencia_id' => $this->co,
                'estado' => $this->activar,
        ]);

        $this->reset(['id_res','nom_res','co', ]);
        session()->flash('message', 'resultado creado exitósamente.');
        
        }
        else{
            session()->flash('mensaje', 'El resultado ya se encuentra registardo en el sistema.');
        }
        
    }


    public function edit( Resultado $r){

        $this->id_res = $r->codigo_resultado;
        $this->nom_res = $r->name;
        $this->co = $r->competencia_id;
        // $this->est = $r->estado;
        $this->ids = $r->id;

        $this->cambio = "update";
        $this->Validacion();
    }

    public function update(){
        
        $validatedDate = $this->validate([
            'id_res' => 'required',
            'nom_res' => 'required',
            'co' => 'required',
            
        ]);

      
        $res =  Resultado::find($this->ids);

        $res->update([
            'codigo_resultado' => $this->id_res,
            'name' => $this->nom_res,
            'competencia_id' => $this->co
            
        ]);

        $this->reset(['id_res','nom_res','co', 'ids','cambio']);
        session()->flash('message', 'resultado modificado exitósamente.');
    

    }

    public function editEstado($r){

        $resul =  Resultado::where('id',$r)->first();

        $this->id_res = $resul->codigo_resultado;
        $this->nom_res = $resul->name;
        $this->co = $resul->competencia_id;
        $this->est = $resul->estado;
        $this->ids = $resul->id;
    }


    public function updateEstado(){

        $res =  Resultado::find($this->ids);

        $res->update([
            'codigo_resultado' => $this->id_res,
            'name' => $this->nom_res,
            'competencia_id' => $this->co,
            'estado' => $this->desactivar,
            
        ]);

        $this->reset(['id_res','nom_res','co', 'ids','cambio']);
        
    
    }

    public function desactivar($r){
        // $this->reset(['idf','nomf', 'ids','cambio']);
        $this->editEstado($r);
        $this->updateEstado();

    }

    
    public function Validacion(){

        $validatedDate = $this->validate([
            'id_res' => 'nullable',
            'nom_res' => 'nullable',
            'co' => 'nullable',
            
        ]);
  
    }

    private function validarCreado(){

        $resultado = Resultado::all();

        $contarResultados = 0;
        $contador = 0;

        foreach ($resultado as $obj) {
           
            if (($this->id_res == $obj->codigo_resultado)&&($this->nom_res == $obj->name)) {
                $contarResultados ++;
            }
        }

        if ($contarResultados > 0) {
            // session()->flash('message', 'resultado ya se encuentra registardo.');
            $contador = $contarResultados;
        }

        return $contador;
    }

    public function cancelar(){
        $this->reset(['id_res','nom_res','co', 'ids','cambio']);
    }

    public function limpiar(){
        $this->reset(['id_res','nom_res','co', 'ids']);
        $this->Validacion();
    }

    public function clear(){
        $this->search = '';
        $this->perPage = '5';
    }

    
}
