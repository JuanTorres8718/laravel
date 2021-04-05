<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Firma;
use App\Models\ListaChequeo;
use App\Models\Instructor;

class FirmasController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(@livewire('createFirma'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'lista_chequeo_id' => 'required',
            'instructor_id' => 'required',
            'image_firma' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'observaciones' => 'required',
            ]);
    
           
        $input = $request->all();

        if ($image_firma = $request->file('image_firma')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image_firma->getClientOriginalExtension();
            $image_firma->move($destinationPath, $profileImage);
            $input['image_firma'] = "$profileImage";
        }
    
        Firma::create($input);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $data['firma_id'] = Firma::where($where)->first();
        return view('firma.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'lista_chequeo_id' => 'required',
            'instructor_id' => 'required',
            'image_firma' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'observaciones' => 'required',
            ]);
    
        $input = $request->all();
  
        if ($image_firma = $request->file('image_firma')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image_firma->getClientOriginalExtension();
            $image_firma->move($destinationPath, $profileImage);
            $input['image_firma'] = "$profileImage";
        }else{
            unset($input['image_firma']);
        }
          
        $firma->update($input);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
