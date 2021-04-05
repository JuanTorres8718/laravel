<form action="" enctype="multipart/form-data" >
    @csrf
    <a href="#edi" name="edi"></a>
    <div class="row">

        <div class="col-md-6">
            <div class="mb-3">
                <label for="intructor" class="block uppercase text-gray-700 text-xs font-bold">Código Instructor</label>
                <select wire:model="instructor_id" placeholder="competencia"
                    class="p-1 block w-full bg-gray-200 rounded text-gray-900 focus:bg-white focus:outline-none border border-gray-200 focus:border-gray-500"
                    id="js-example-basic-single">
                    <option value="">Seleccione...</option>

                    @foreach ($instructor as $i)
                        <option value="{{ $i->id }}">{{ $i->numero_documento }}</option>
                    @endforeach

                </select>
                @error('instructor_id') <span
                        class="text-danger">{{ 'el campo es de obligatorio diligenciamiento' }}</span>
                @enderror

            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="lista" class="block uppercase text-gray-700 text-xs font-bold">Lista chequeo</label>
                <select wire:model="lista_chequeo_id"
                    class="p-1 block w-full bg-gray-200 rounded text-gray-900 focus:bg-white focus:outline-none border border-gray-200 focus:border-gray-500">
                    <option value="">Seleccione...</option>

                    @foreach ($lista as $l)
                        <option value="{{ $l->id }}">{{ $l->codigo_lista }}</option>
                    @endforeach

                </select>

                @error('lista_chequeo_id') <span
                    class="text-danger">{{ 'el campo es de obligatorio diligenciamiento' }}</span>@enderror

            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="obs" class="block uppercase text-gray-700 text-xs font-bold">Observaciones</label>
                <textarea wire:model="observaciones" placeholder="ingrese observaciones"
                    class="block w-full p-2 bg-gray-200 rounded text-gray-900 focus:bg-white focus:outline-none border border-gray-200 focus:border-gray-500"></textarea>

                @error('observaciones') <span
                    class="text-danger">{{ 'el campo es de obligatorio diligenciamiento' }}</span>@enderror

            </div>
        </div>


        <div class="col-md-6">
            <div class="mb-3">
                <label for="firma" class="block uppercase text-gray-700 text-xs font-bold">Firma</label>
                <input wire:model="imagen_firma" type="file" placeholder="Selecione imagen"
                    class="block w-full bg-gray-200 rounded text-gray-900 focus:bg-white focus:outline-none border border-gray-200 focus:border-gray-500">

                @error('imagen_firma') <span
                    class="text-danger">{{ 'el campo es de obligatorio diligenciamiento' }}</span>@enderror


            </div>
        </div>

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
    
</form>
