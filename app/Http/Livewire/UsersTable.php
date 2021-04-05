<?php

namespace App\Http\Livewire;

use Livewire\Component;
use app\Models\User;
use Livewire\WithPagination;

class UsersTable extends Component
{
    //Usaremos el treat WithPagination para aplicar paginación vía ajax y 
    //que solo se recrague la tabla y no toda la página al paginar la lista
    use WithPagination;

    public $search = '';
    public $perPage= '5';

    //Atributos del modelo User
    public $id_usuario, $numero_documento, $name, $name_2, $last_name, $last_name_2, $email, $password, $phone_number, $address_number, $estado;

    public $updateMode = false;

    //El valor del queryString en la barra de direcciones será el mismo que el del campo de búsqueda, excepto cuando este valor sea nulo
    protected $queryString = [
        'search' => ['except'=>''],
        'perPage' => ['except'=>'5']
    ];

    //RENDER
    public function render()
    {

        $this -> numero_documento = User::all();

        return view('livewire.users-table', [
            'users' => User::where('name', 'LIKE',"%{$this->search}%")
                ->orWhere('last_name', 'LIKE',"%{$this->search}%")
                ->orWhere('numero_documento', 'LIKE',"%{$this->search}%")
                ->orWhere('phone_number', 'LIKE',"%{$this->search}%")
                ->orWhere('address_number', 'LIKE',"%{$this->search}%")
                ->orWhere('email', 'LIKE',"%{$this->search}%")
                ->orWhere('estado', 'LIKE',"%{$this->search}%")
                ->paginate($this->perPage)
        ]);        
    }

    //VACIAR CAMPOS
    private function resetInputFields(){
        $this->numero_documento='';
        $this->name = '';
        $this->name_2 = '';
        $this->last_name = '';
        $this->last_name_2 = '';
        $this->email = '';
        $this->password='';
        $this->phone_number='';
        $this->address_number='';
    }

    //REGISTRAR USUARIO
    public function store()
    {
        $validatedDate = $this->validate([
            'numero_documento' => 'required',
            'name' => 'required',
            'name_2' => 'nullable',
            'last_name' => 'required',
            'last_name_2' => 'nullable',
            'email' => 'required|email',
            'password' => 'required|password',
            'phone_number' => 'required',
            'address_number' => 'required'

        ]);

        User::create($validatedDate);

        session()->flash('message', 'Usuario creado exitósamente.');

        $this->resetInputFields();

    }

    //EDITAR USUARIO
    public function edit($id)
    {
        $this->updateMode = true;
        $user = User::where('id',$id)->first();
        $this->id_usuario = $user->id;
        $this->numero_documento = $user->numero_documento;
        $this->name = $user->name;
        $this->name_2 = $user->name_2;
        $this->last_name = $user->last_name;
        $this->last_name_2 = $user->last_name_2;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->phone_number = $user->phone_number;
        $this->address_number = $user->address_number;
        
    }

    // CANCELAR
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();


    }

    // ACTUALIZAR
    public function update()
    {
    //     $validatedDate = $this->validate([
    //         // 'numero_documento' => 'required',
    //         'name' => 'required',
    //         // 'name_2' => 'nullable',
    //         // 'last_name' => 'required',
    //         // 'last_name_2' => 'nullable',
    //         'email' => 'required|email'
    //         // 'password' => 'required|password',
    //         // 'phone_number' => 'required',
    //         // 'address_number' => 'required'
    //     ]);

        // if ($id) {
            $user = User::find($this->id_usuario);
            // $user = User::where('numero_documento',$id)->first();
            $user->update([
                'name' => $this->name,
                'name_2' => $this->name_2,
                // 'last_name' => $this->last_name,
                // 'last_name_2' => $this->last_name_2,
                // 'email' => $this->email,
                // 'password' => $this->password,
                'phone_number' => $this->phone_number,
                'address_number' => $this->address_number
            ]);

            

            // User::create($validatedDate);
            $this->updateMode = false;
            session()->flash('message', 'Users Updated Successfully.');
            $this->resetInputFields();
            // return with('success', 'El producto ha sido guardado');
            // $user->update();
        // }
    }

    // ELIMINAR
    public function delete($id)
    {
        if($id){
            User::where('id',$id)->delete();
            session()->flash('message', 'Users Deleted Successfully.');
        }
    }

    // LIMPIAR CUADRO DE BÚSQUEDA
    public function clear(){
        $this->search = '';
        $this->page = 1;
        $this->perPage = '5';
    }
}

