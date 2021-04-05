<form enctype="multipart/form-data">
    @csrf
    
        <div class="row">
            
            <div class="col-md-4">
                <div class="mb-3">
                    
                    <label for="intructor" 
                        class="block uppercase text-gray-700 text-xs font-bold">Código Instructor</label>
                       
                        <select wire:model="instructor_id" id="select2" 
                        class="p-1 w-full border border-gray-200"  >
                        <option value="">Seleccione...</option>
                        @foreach ($instructor as $i) 
                            <option  
                            value="{{ $i->id }}">{{ $i->numero_documento }}</option>
                        @endforeach

                    </select>
                    
                       @error('instructor_id') <span
                            class="text-danger">{{ 'el campo es de obligatorio diligenciamiento' }}</span>
                        @enderror 
                   
                    

                </div>
            </div>
            

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="lista"
                        class="block uppercase text-gray-700 text-xs font-bold">Lista chequeo</label>
                    <select wire:model="lista_chequeo_id"  id="select3"
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

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="obs" class="block uppercase text-gray-700 text-xs font-bold">Observaciones</label>
                    <textarea wire:model="observaciones" cols="15" rows="1,10" placeholder="ingrese observaciones"
                        class="block  w-full bg-gray-200 rounded text-gray-900 focus:bg-white focus:outline-none border border-gray-200 focus:border-gray-500"></textarea>

                    @error('observaciones') <span
                        class="text-danger">{{ 'el campo es de obligatorio diligenciamiento' }}</span>@enderror

                </div>
            </div>
        </div>




        <div class="row">
            


            <div class="col-md-12">
                <div class="mb-3">

                    <label for="firma" class="block uppercase text-gray-700 text-xs font-bold">Firma</label>
                    
                    {{-- @if ($imagen_firma)
                    Photo Preview:
                    <!-- <img class="w-20 h-20" src="{{ $imagen_firma->temporaryUrl() }}"> -->
                    @endif --}}
                    
                    <input type="file"  wire:model="imagen_firma"  placeholder="Selecione imagen" name="imagen_firma" id="imagen_firma"
                        class="block w-full bg-gray-200 rounded text-gray-900 focus:bg-white focus:outline-none border border-gray-200 focus:border-gray-500">

                    @error('imagen_firma') <span
                        class="text-danger">{{ 'el campo es de obligatorio diligenciamiento' }}</span>@enderror

                </div>
            </div>

        </div>
 

        <button wire:click="store"
            class="btn-outline-primary transition duration-300 ease-in-out focus:outline-none focus:shadow-outline border border-blue-700 hover:bg-blue-700 text-blue-700 hover:text-white font-normal py-2 px-4 rounded">crear
            firma</button>

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
    
</form>

{{-- @push('script')
<script>
    document.addEventListener("livewire:load", () => {
        
            $('#select2').select2()
        
         });
</script>


@endpush --}}

{{-- @push('script')
<script>
document.addEventListener("livewire:load", () => {
    $('#select3').select2();
});
</script>
@endpush --}}

