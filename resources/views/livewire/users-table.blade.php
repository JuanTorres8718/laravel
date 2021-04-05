<div>
   
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}  SENA SIOSOP
        </h2>
    </x-slot>

    
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <div class="flex bg-gray-300 px-4 py-3  border-t border-orange-400 sm:px-6">
                @if($updateMode)
                    @include('livewire.updateUser')
                @else
                    @include('livewire.createUser')
                @endif
              </div>              
                              <!-- This example requires Tailwind CSS v2.0+ -->
              <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-orange-400 sm:rounded-lg">
                        <!-- Declaramos la variable search que debe estar predefinida en nuestra clase UsersTable-->
                        <!-- {{ $search }} -->
                      <div class="flex bg-orange-400 px-4 py-3  border-t border-gray-300 sm:px-6">
                          <!-- Relacionamos la variable search con el input -->
                          <input
                              wire:model="search" 
                              class="form-input rounded-md shadow-sm mt-1 block w-full" 
                              type="text" 
                              placeholder="Buscar...">
                          <div class="form-input rounded-md shadow-sm mt-1 ml-6 block">
                            <!-- Vinculamos la propiedad perPage con el select -->
                            <select wire:model="perPage" class="outline-none text-gray-500 text-sm">
                              <option value="5">5 por página</option>
                              <option value="10">10 por página</option>
                              <option value="15">15 por página</option>
                              <option value="20">20 por página</option>
                              <option value="25">25 por página</option>
                            </select>
                          </div>
                          @if($search != '')
                          <!-- Se llama el método clear que ha sido previamente consigurado en la clase UsersTable -->
                          <!-- <button wire:click="clear" class="form-input rounded-md shadow-sm mt-1 ml-6 block">X</button> -->
                          <button wire:click="clear" class="btn-primary transition duration-300 ease-in-out focus:outline-none focus:shadow-outline bg-gray-400 hover:bg-gray-700 text-white font-normal py-2 px-4 mr-1 rounded ml-6">X</button>
                          @endif
                      </div>
                      <!--Qué pasa si no se encuentran reesultados para la búsqueda?  -->
                      @if($users->count())   
                      <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-orange-400">
                          <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-900 uppercase tracking-wider">
                            # Documento
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-900 uppercase tracking-wider">
                            Estado
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-900 uppercase tracking-wider">
                              Nombres y apellidos
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-900 uppercase tracking-wider">
                              Correo electrónico
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-900 uppercase tracking-wider">
                              Teléfono
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-900 uppercase tracking-wider">
                              Dirección
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-900 uppercase tracking-wider">
                              Opciones
                            </th>
                          </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-300">
                          @foreach($users as $user)

                          <tr class="bg-gray-200">
                            <td class="px-6 py-4 whitespace-nowrap bg">
                              <div class="flex items-center">
                                <!-- <div class="flex-shrink-0 h-10 w-10">
                                  <img class="h-10 w-10 rounded-full" src="{{$user -> profile_photo_url}}" alt="{{$user -> name}}">
                                </div> -->
                                <div class="ml-4">
                                  <div class="text-sm font-bold text-gray-900">
                                      {{$user -> numero_documento}} 
                                  </div>
                                  
                                </div>
                              </div>
                            </td>
                            <td>
                              <div class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                      {{$user ->estado}}
                                  </span>
                              </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                              <div class="text-sm text-black">{{$user -> name}} {{$user -> name_2}} </div>
                              <div class="text-sm text-gray-900">{{$user -> last_name}} {{$user -> last_name_2}} </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-black">{{$user -> email}} </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                              <div class="text-sm text-black">{{$user -> phone_number}} </div>                           
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                              <div class="text-sm text-gray-900">{{$user -> address_number}} </div>  
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                              <!-- <form action="" method="post"> -->
                                  <a class="btn-outline-primary transition duration-300 ease-in-out focus:outline-none focus:shadow-outline border border-green-700 hover:bg-green-700 text-green-700 hover:text-white font-normal py-2 px-4 rounded">Ver</a>
                                  <a wire:click="edit({{ $user->id }})" class="btn-outline-primary transition duration-300 ease-in-out focus:outline-none focus:shadow-outline border border-blue-700 hover:bg-blue-700 text-blue-700 hover:text-white font-normal py-2 px-4 rounded">Editar</a>                        
                                  
                                  <a wire:click="delete({{ $user->id }})" class="btn-outline-primary transition duration-300 ease-in-out focus:outline-none focus:shadow-outline border border-red-700 hover:bg-red-700 text-red-700 hover:text-white font-normal py-2 px-4 rounded">Eliminar</a>
                              <!-- </form> -->
                              <!-- <a href="#" class="text-indigo-600 hover:text-indigo-900">Editar</a> -->
                            </td>
                          </tr>
                          
                          
                          @endforeach
                          <!-- More rows... -->
                        </tbody>
                      </table>
                      <!-- Paginación y número de resultados -->
                      <div class="bg-orange-400">
                          {{ $users->links() }}
                      </div>
                      @else
                      <div class="bg-white px-4 py-3  border-t border-gray-200 sm:px-6">
                      No hay resultados para "{{$search}}" en la página "{{$page}}" al mostrar "{{$perPage}}" por página
                      </div>
                      @endif
                    </div>
                  </div>
                </div>
              </div>

            </div>
        </div>
    </div>
</div>
