{{--  <div class="py-6">
    <div class="max-w-7x1 mx-auto ms:px-6 lg:px-8 ">
        <div class="bg-white overflow-hidden shadow-xl ms:rounded-lg rounded">  --}}

            <div class="container mx-auto mt-2">
                <x-slot name="header">
                    <h2 class="font-semibold uppercase text-xl text-gray-800 leading-tight text-center">
                        {{ __('Firmas') }} SENA SIOSOP

                    </h2>
                </x-slot>

                <br>
                {{-- inicio formulario de insert and update --}}
                <div class="bg-white rounded-lg shadow overflow-hidden min-w-full max-auto p-4 mb-10">
                    
                    @if ($cambio == 'store' )
                    
                        @include('livewire.createFirma')

                    @else
                     @include('livewire.updateFirma')
                    @endif
                </div>
            {{-- inicio table de listado --}}

            <div class="rounded-lg shadow overflow-hidden mb-8">

                {{-- inicia el buscar --}}
                <div class="flex flex-col ">
                    <div class="flex bg-orange-500 px-4 py-3  border-t border-gray-300 sm:px-6">
                        <!-- Relacionamos la variable search con el input -->

                        <input wire:model="search" class="form-input rounded-md shadow-sm mt-1 block w-full" type="text"
                            placeholder="Buscar...">

                        <div class="form-input rounded-md shadow-sm mt-1 ml-6 block">
                            <!-- Vinculamos la propiedad perPage con el select -->
                            <select wire:model="perPage" class="outline-none text-gray-500 text-sm"
                                style="color: black">
                                <option value="5"> 5 por página</option>
                                <option value="10"> 10 por página</option>
                                <option value="15"> 15 por página</option>
                                <option value="20"> 20 por página</option>
                            </select>
                        </div>
                        @if ($search != '')
                            <!-- Se llama el método clear que ha sido previamente consigurado en la clase UsersTable -->
                            <!-- <button wire:click="clear" class="form-input rounded-md shadow-sm mt-1 ml-6 block">X</button> -->
                            <button wire:click="clear"
                                class="btn-primary transition duration-300 ease-in-out focus:outline-none focus:shadow-outline bg-gray-400 hover:bg-gray-700 text-white font-normal py-2 px-4 mr-1 rounded ml-6">X</button>
                        @endif
                    </div>


                    {{-- inicio table --> --}}

                    <br>
                    <div class="table-responsive">
                        <table class="min-w-full divide-y divide-gray-200 bg-white rounded-lg shadow overflow-hidden">
                            <thead class="bg-orange-500">
                                <tr
                                    class="px-6 py-3 text-left text-xs font-bold text-gray-900  tracking-wider">
                                    {{-- <th class="text-center">Id</th> --}}
                                    <th class="text-center">Imagen</th>
                                    <th class="text-center">Instructor</th>
                                    <th class="text-center">Lista</th>
                                    <th class="text-center">Observaciones</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                            </thead>

                            <tbody class=" bg-white divide-y divide-gray-300">
                                @foreach ($firma as $f)
                                    <tr class="bg-gray-200">
                                    
               
                                        <td>
                                            <div class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">

                                            
                                            </div>
                                        </td>
                                        <td>
                                            <div class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-black text-center">
                                                   @foreach ($instructor as $ins)

                                                    @if ($ins->id == $f->instructor_id)
                                                        {{$ins->numero_documento}}
                                                    @endif
                                                   
                                                   @endforeach
                                             
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                                <span  class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-black text-center">
                                                  
                                                   
                                                @foreach ($lista as $l)

                                                @if ($l->id == $f->lista_chequeo_id)
                                                    {{$l->codigo_lista}}
                                                @endif
                                               
                                               @endforeach

                                                </span>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                                <span  class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-black text-center">
                                                  
                                                    {{$f->observaciones}}

                                                </span>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            
                                            <a href="#edi" name="edi"><button type="button"
                                                wire:click="edit({{ $f }})"
                                                class="btn-outline-primary transition duration-300 ease-in-out focus:outline-none focus:shadow-outline border border-blue-700 hover:bg-blue-700 text-blue-700 hover:text-white font-normal py-2 px-4 rounded btn-md responsive"
                                                style="text-decoration: none">editar</button></a>
                                            <button type="button" wire:click="$emit('desactivar',{{ $f}})"
                                                class="eliminarp btn-outline-primary transition duration-300 ease-in-out focus:outline-none focus:shadow-outline border border-blue-700 hover:bg-red-700 text-red-700 hover:text-white font-normal py-2 px-4 rounded btn-md responsive">desactivar</button>
                                   
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="bg-gray-100 px-6 py-4 border-t border-gray-200" style="color: black">
                        {{ $firma->render() }}
                    </div>

                    @if ($firma->count())  
                    @else
                        <div class="bg-white px-4 py-3  border-t border-gray-200 sm:px-6">
                            No hay registro para "{{ $search }}".
                        </div>
                    @endif
                </div>
            </div>
        </div>
    {{--  </div>
</div>
</div>  --}}

@push('script')
    <script>
        document.addEventListener('livewire:load', function() {

            @this.on('desactivar', id => {

                Swal.fire({
                    title: 'estas seguro?',
                    text: "no podrás revertir la acción!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'sí, desactivar!',
                    cancelButtonText: 'No, cancelar!',
                    reverseButtons: true
                }).then((result) => {
                    // @this.call('eliminar',id)
                    if (result.isConfirmed) {
                        @this.call('desactivar', id)
                        Swal.fire(
                            'Desactivado!',
                            'se ha desactivado correctamente.',
                            'success'
                        )
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        Swal.fire(
                            'Cancelado',
                            'gracias por confirmar :)',
                            'error'
                        )
                    }
                })
            })
        })

    </script>

@endpush



<!-- Modal -->
<div class="modal fade border" id="modal1" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Elija la opción a gestionar</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row align-items-center">
                    <div class="col-sm-6 ">
                        <x-jet-nav-link href="">
                            <div class="text-black hover:bg-orange-500  hover:text-white border border-black rounded px-10 py-2"
                                style="list-style: none">
                                {{ __('firma') }}
                            </div>
                        </x-jet-nav-link>
                    </div>
                    <div class="col-sm-6 ">
                        <x-jet-nav-link href="{{route('resultado') }}">
                            <div class="text-black hover:bg-orange-500  hover:text-white border border-black rounded px-10 py-2"
                                style="list-style: none">
                                {{ __('Resultados') }}
                            </div>
                        </x-jet-nav-link>
                    </div>

                </div>
                <div class="row align-items-center">
                    <div class="col-sm-6 ">
                        <x-jet-nav-link href="">
                            <div class="text-black hover:bg-orange-500  hover:text-white border border-black rounded px-10 py-2"
                                style="list-style: none">
                                {{ __('Proyecto') }}
                            </div>
                        </x-jet-nav-link>
                    </div>
                    <div class="col-sm-6 ">
                        <x-jet-nav-link href="{{route('resultado') }}">
                            <div class="text-black hover:bg-orange-500  hover:text-white border border-black rounded px-10 py-2"
                                style="list-style: none">
                                {{ __('Resultados') }}
                            </div>
                        </x-jet-nav-link>
                    </div>

                </div>

               

            </div>
            <div class="modal-footer">
                <button type="button"
                    class="btn focus:shadow-outline border border-blue-700 hover:bg-blue-700 text-blue-700 hover:text-white d-grid gap-2 col-6 mx-auto d-grid gap-2 col-6 mx-auto"
                    data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>









