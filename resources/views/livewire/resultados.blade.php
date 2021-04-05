<div class="py-6">
    <div class="max-w-7x1 mx-auto ms:px-6 lg:px-8 ">
        <div class="bg-white overflow-hidden shadow-xl ms:rounded-lg rounded">

            <div class="container mx-auto mt-2">
                <x-slot name="header">
                    <h2 class="font-semibold uppercase text-xl text-gray-800 leading-tight text-center">
                        {{ __('Resultados') }} SENA SIOSOP

                    </h2>
                </x-slot>

                <br>
                {{-- inicio formulario de insert and update --}}
                <div class="bg-white rounded-lg shadow overflow-hidden min-w-full max-auto p-4 mb-10">
                   
                   
                        
                    @if ($cambio == 'store')
                    @if (session('mensaje'))
                    <div class="alert alert-danger text-red-500" align="center">
                        {{session('mensaje')}}
                    </div>
                    @endif
                    <br>



                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="idr"
                                        class="block uppercase text-gray-700 text-xs font-bold">código</label>
                                    <input type="number" min="1" wire:model="id_res" id="idr"
                                        placeholder="ingrese código resultado (Sólo números)" pattern="números"
                                        class="block w-full bg-gray-200 rounded text-gray-900 focus:bg-white focus:outline-none border border-gray-200 focus:border-gray-500">



                                    @error('id_res') <span
                                            class="text-danger">{{ 'el campo es de obligatorio diligenciamiento' }}</span>
                                    @enderror




                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="comp"
                                        class="block uppercase text-gray-700 text-xs font-bold">competencia</label>
                                    <select wire:model="co" placeholder="competencia"
                                        class="p-1 block w-full bg-gray-200 rounded text-gray-900 focus:bg-white focus:outline-none border border-gray-200 focus:border-gray-500">
                                        <option value="">Seleccione...</option>

                                        @foreach ($comp as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach


                                    </select>

                                    @error('co') <span
                                        class="text-danger">{{ 'el campo es de obligatorio diligenciamiento' }}</span>@enderror

                                </div>
                            </div>
                        </div>





                        <div class="mb-3">
                            <label for="nombre" class="block uppercase text-gray-700 text-xs font-bold">nombre
                                resultado</label>
                            <input wire:model="nom_res" rows="4" placeholder="ingrese nombre resultado"
                                class="block w-full bg-gray-200 rounded text-gray-900 focus:bg-white focus:outline-none border border-gray-200 focus:border-gray-500">

                            @error('nom_res') <span
                                class="text-danger">{{ 'el campo es de obligatorio diligenciamiento' }}</span>@enderror


                        </div>

                        <button wire:click="store"
                            class="btn-outline-primary transition duration-300 ease-in-out focus:outline-none focus:shadow-outline border border-blue-700 hover:bg-blue-700 text-blue-700 hover:text-white font-normal py-2 px-4 rounded">crear
                            resultado</button>

                        <button wire:click="cancelar"
                            class="btn-outline-primary transition duration-300 ease-in-out focus:outline-none focus:shadow-outline border border-blue-700 hover:bg-red-700 text-red-700 hover:text-white font-normal py-2 px-4 rounded">limpiar</button>

                        @if (session()->has('message'))
                            <script>
                                Swal.fire(
                                    'excelente!',
                                    '{{ session('message') }}',
                                    'success'
                                )

                            </script>
                        @endif
                    @else
                        <div class="row">
                            <a href="#edi" name="edi"></a>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="idr"
                                        class="block uppercase text-gray-700 text-xs font-bold">código</label>
                                    <input type="number" min="1" wire:model="id_res" id="idr"
                                        placeholder="ingrese código resultado"
                                        class="block w-full bg-gray-200 rounded text-gray-900 focus:bg-white focus:outline-none border border-gray-200 focus:border-gray-500">

                                    @error('id_res') <span
                                        class="text-danger">{{ 'el campo es de obligatorio diligenciamiento' }}</span>@enderror

                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="comp"
                                        class="block uppercase text-gray-700 text-xs font-bold">competencia</label>
                                    <select wire:model="co" placeholder="competencia"
                                        class="p-1 block w-full bg-gray-200 rounded text-gray-900 focus:bg-white focus:outline-none border border-gray-200 focus:border-gray-500">
                                        <option value="">Seleccione...</option>

                                        @foreach ($comp as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach


                                    </select>

                                    @error('co') <span
                                        class="text-danger">{{ 'el campo es de obligatorio diligenciamiento' }}</span>@enderror

                                </div>
                            </div>
                        </div>





                        <div class="mb-3">
                            <label for="nombre" class="block uppercase text-gray-700 text-xs font-bold">nombre
                                resultado</label>
                            <input wire:model="nom_res" rows="4" placeholder="ingrese nombre resultado"
                                class="block w-full bg-gray-200 rounded text-gray-900 focus:bg-white focus:outline-none border border-gray-200 focus:border-gray-500">

                            @error('nom_res') <span
                                class="text-danger">{{ 'el campo es de obligatorio diligenciamiento' }}</span>@enderror


                        </div>


                        <button wire:click="update"
                            class="btn-outline-primary transition duration-300 ease-in-out focus:outline-none focus:shadow-outline border border-blue-700 hover:bg-blue-700 text-blue-700 hover:text-white font-normal py-2 px-4 rounded">actualizar
                            resultado</button>
                        <button wire:click="limpiar"
                            class="btn-outline-primary transition duration-300 ease-in-out focus:outline-none focus:shadow-outline border border-red-700 hover:bg-red-700 text-red-700 hover:text-white font-normal py-2 px-4 rounded">limpiar</button>

                        <button wire:click="cancelar"
                            class="btn-outline-primary transition duration-300 ease-in-out focus:outline-none focus:shadow-outline border border-red-700 hover:bg-green-700 text-green-700 hover:text-white font-normal py-2 px-4 rounded">volver</button>


                        @if (session()->has('message'))
                            <script>
                                Swal.fire(
                                    'excelente!',
                                    '{{ session('message') }}',
                                    'success'
                                )

                            </script>
                        @endif
                </div>
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
                    
                    @if ($res->count())
                    <br>
                    <div class="table-responsive">
                        <table class="min-w-full divide-y divide-gray-200 bg-white rounded-lg shadow overflow-hidden">
                            <thead class="bg-orange-500">
                                <tr
                                    class="px-6 py-3 text-left text-xs font-bold text-gray-900 uppercase tracking-wider">
                                    {{-- <th class="text-center">id</th> --}}
                                    <th class="text-center">código</th>
                                    <th class="text-center">nombre</th>
                                    <th class="text-center">competencia</th>
                                    <th class="text-center">opciones</th>
                                </tr>
                            </thead>

                            <tbody class=" bg-white divide-y divide-gray-300">
                                @foreach ($res as $r)
                                @if ($r == ($search.".".$r->resultado_id > 0))
                                    
                                
                                    <tr class="bg-gray-200">
                                        {{-- <td>
<div class="px-6 py-4 whitespace-nowrap text-center text-md text-gray-500">
<span class="px-2 inline-flex text-md leading-5 font-bold rounded-full  text-center" style="color: black">
{{$r->id}}
</span>
</div>     
</td> --}}
                                        <td>
                                            <div class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-black text-center">
                                                    {{ $r->codigo_resultado }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-black text-center">
                                                    {{ $r->name }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-black text-center">
                                                    @foreach ($comp as $c)
                                                        @if ($c->id == $r->competencia_id)
                                                            {{$c->name }}
                                                        @endif
                                                    @endforeach

                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <a href="#edi" name="edi"><button type="button"
                                                    wire:click="edit({{ $r }})"
                                                    class="btn-outline-primary transition duration-300 ease-in-out focus:outline-none focus:shadow-outline border border-blue-700 hover:bg-blue-700 text-blue-700 hover:text-white font-normal py-2 px-4 rounded btn-md responsive"
                                                    style="text-decoration: none">editar</button></a>
                                            <button type="button" wire:click="$emit('desactivar',{{ $r }})"
                                                class="eliminarp btn-outline-primary transition duration-300 ease-in-out focus:outline-none focus:shadow-outline border border-blue-700 hover:bg-red-700 text-red-700 hover:text-white font-normal py-2 px-4 rounded btn-md responsive">desactivar</button>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="bg-gray-100 px-6 py-4 border-t border-gray-200" style="color: black">
                        {{ $res->render() }}
                    </div>

                   
                    @else
                        <div class="bg-white px-4 py-3  border-t border-gray-200 sm:px-6">
                            No hay registro para "{{ $search }}".
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@push('script')
    <script>
        document.addEventListener('livewire:load', function() {

            @this.on('desactivar', id => {

                Swal.fire({
                    title: 'estas seguro?',
                    text: "no podras revertir la acción!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'si, desactivar!',
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
                                {{ __('Proyecto') }}
                            </div>
                        </x-jet-nav-link>
                    </div>
                    <div class="col-sm-6 ">
                        <x-jet-nav-link href="{{ route('resultado') }}">
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







