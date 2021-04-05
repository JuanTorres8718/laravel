<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Firma;
use App\Models\ListaChequeo;
use App\Models\Instructor;

class Firmas extends Component
{
    use WithFileUploads;
    use WithPagination;
    
    public $search = '';
    public $perPage= '5';
    public $lista_chequeo_id, $instructor_id, $observaciones, $ids,$file, $est;
    public $imagen_firma, $filename;
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
        $fi = Firma::all();
        return view('livewire.firmas',compact('lista', 'instructor','fi'),[

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
        
        // $this->validate($request, [
        //     'lista_chequeo_id' => 'required',
        //     'instructor_id' => 'required',
        //     'imagen_firma' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1048',
        //     'observaciones' => 'required',
        // ]);
        $name = time();

        $file = $request->file('imagen_firma')->storeAs('imagen', $name.".jpg", 'public_uploads');
        //  $file = $this->imagen_firma->store('img');


        Firma::create([
            'lista_chequeo_id' => $this->lista_chequeo_id,
            'instructor_id' => $this->instructor_id,
            'observaciones' => $this->observaciones,
            'estado' => $this->activar,
            'imagen_firma' =>$file,
        ]);

        // $this->reset(['lista_chequeo_id','instructor_id','observaciones', 'imagen_firma' ]);
        session()->flash('message', 'firma registrada exitósamente.');
    }

    
    
}

// dada

// public function store(Request $request){
        
//     $this->validate([
//         'lista_chequeo_id' => 'required',
//         'instructor_id' => 'required',
//         'imagen_firma' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//         'observaciones' => 'required',
//     ]);

//     $llenar = $this->all();

//     if ($imagen_firma = $this->file('imagen_firma')) {
//         $destinationPath = 'image/';
//         $profileImage = date('YmdHis') . "." . $imagen_firma->getClientOriginalExtension();
//         $imagen_firma->move($destinationPath, $profileImage);
//         $llenar['imagen_firma'] = "$profileImage";
//     }

//     Firma::create($llenar);
// }

// public function store(){
        
//         $validatedData = $this->validate([
//             'lista_chequeo_id' => 'required',
//             'instructor_id' => 'required',
//             'observaciones' => 'required',
//             'imagen_firma' => 'image',
//         ]);
//         // foreach ($this->imagen_firma as $firma) {
//         //     $firma->store('firma');
//         // }
//         $filename = $this->imagen_firma->store('files');
//         $validatedData['imagen_firma'] = $filename;
//         Firma::create([
//             'lista_chequeo_id' => $this->lista_chequeo_id,
//             'instructor_id' => $this->instructor_id,
//             'observaciones' => $this->observaciones,
//             'estado' => $this->activar,
//             'imagen_firma' =>$filename,
//         ]);
//     }
//     public function store(){

//        $validatedData = $this->validate([
            
//             'lista_chequeo_id' => 'required',
//             'instructor_id' => 'required',
//             'observaciones' => 'required',
//             'imagen_firma' => 'image',
//         ]);

//         $imagen_firma = $this->imagen_firma->store('files');
//         $validatedData['imagen_firma'] = $imagen_firma;
  
//         Firma::create($validatedData);
          
//          session()->flash('message', 'firma creada exitósamente.');
           
//     }

//     // private function loadimage(TemporaryUploadedFile $imagen_firma){

//     //     $ext = $imagen_firma->getClientOriginalExtension();
//     //     $new_name = time().'.'.$ext;
//     //    $local = Storage::disk('public' )->put('img',$imagen_firma );
//     //     //  Storage::disk('public')->put($imageName,base64_decode($image));
//     //    return $local;
//     // }    

//     public function edit( Firma $f){

//         $this->lista_chequeo_id = $f->lista_chequeo_id;
//         $this->instructor_id = $f->instructor_id;
//         $this->observaciones = $f->observaciones;
//         $this->imagen_firma = $f->imagen_firma;
//         // $this->est = $r->estado;
//         $this->ids = $f->id;

//         $this->cambio = "update";
//         // $this->Validacion();
//     }

//     public function update(){

//       $this->validate([
            
//             'lista_chequeo_id' => 'required',
//             'instructor_id' => 'required',
//             'observaciones' => 'required',
//             'imagen_firma' => 'required|image',
//         ]);
        
//         $filename = $this->imagen_firma->store('files');
       

//         $fir =  Firma::find($this->ids);

//         $fir->update([
//             'lista_chequeo_id' => $this->lista_chequeo_id,
//             'instructor_id' => $this->instructor_id,
//             'observaciones' => $this->observaciones,
//             'estado' => $this->activar,
//             'imagen_firma' => $filename,
//         ]);
//             // if (!empty($this->imagen_firma)) {
//             //     $this->imagen_firma->store('files', 'public');
//             // }
            
//             $this->reset(['lista_chequeo_id','instructor_id','observaciones', 'imagen_firma' ]);
//             session()->flash('message', 'firma modificada exitósamente.');
           

//     }
// }

 // if($request->hasFile('imagen_firma')){
        //     if (Input::file('imagen_firma')->isValid()) {
        //         $file = Input::file('imagen_firma');
        //         $destination = 'images/Foldername'.'/';
        //         $ext= $file->getClientOriginalExtension();
        //         $mainFilename = str_random(6).date('h-i-s');
        //         $file->move($destination, $mainFilename.".".$ext);
               
        //     }
        // }

        //otross
           //     $image = $request->input('image'); // image base64 encoded
        //     preg_match("/data:image\/(.*?);/",$image,$image_extension); // extract the image extension
        //     $image = preg_replace('/data:image\/(.*?);base64,/','',$image); // remove the type part
        //     $image = str_replace(' ', '+', $image);
        //     $imageName = 'image_' . time() . '.' . $image_extension[1]; //generating unique file name;
        //     Storage::disk('public')->put($imageName,base64_decode($image));

        // if ($this->hasFile(key: 'imagen_firma')) {
        //    $img ['imagen_firma'] = time().'_'.$this->file(key: 'imagen_firma')->getClientOriginalName();
        //    $this->file(key: 'imagen_firma')->storeAs(path: 'folder_img', name: $img ['imagen_firma']);
        