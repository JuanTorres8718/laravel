<?php

namespace App\Http\Controllers;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Firma;
use App\Models\ListaChequeo;
use App\Models\Instructor;


class FirmaController extends Controller
{
    use WithFileUploads;
    use WithPagination;

    public $search = '';
    public $perPage= '5';
    public $lista_chequeo_id, $instructor_id, $observaciones, $imagen_firma, $ids, $est;
    public $Eidlista, $Eidinst, $Eobs;
    public $cambio = "store";
    public  $activar = 'ACTIVO';
    public $desactivar = 'INACTIVO';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $instructor = Instructor::all();
        $lista = ListaChequeo::all();
        return view('livewire.firmas',compact('lista', 'instructor'),[

            'firma' => Firma::join("instructors","instructors.id","=","firmas.instructor_id")
                            ->join("lista_chequeos", "lista_chequeos.id", "=", "firmas.lista_chequeo_id")
            
            // whereIn('firmas.estado', [$this->activar])
            ->where(function ($query){
             $query->Where('firmas.estado', [$this->activar])
            ->orWhere('instructors.numero_documento', 'LIKE',"%{$this->search}%")
            ->orWhere('lista_chequeos.codigo_lista', 'LIKE',"%{$this->search}%")
            ->orWhere('firmas.observaciones', 'LIKE',"%{$this->search}%");
         
           })
           ->simplePaginate($this->perPage)
        ]);
    }

    public function store(Request $request){

        $request->validate([
        'lista_chequeo_id' => 'required',
        'instructor_id' => 'required',
        'image_firma' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'observaciones' => 'required',
        ]);

        if ($files = $request->file('image_firma')) {

            $destinationPath = 'public/image/'; // upload path
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $insert['image_firma'] = "$profileImage";

        }

        $insert['lista_chequeo_id'] = $request->get('lista_chequeo_id');
        $insert['instructor_id'] = $request->get('instructor_id');
        $insert['observaciones'] = $request->get('observaciones');
        Firma::insert($request->all());
        // return Redirect::to('products')
        // ->with('success','Greate! Product created successfully.');
           
    }
}
