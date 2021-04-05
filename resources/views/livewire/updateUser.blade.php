<form class="">
    <!-- <div class="form-group">
        <input type="hidden" wire:model="id_usuario">
       
        <label for="exampleFormControlInput1">Nombre</label>
        
    </div> -->
    <div>
        <x-jet-label for="name" value="{{ __('Primer nombre') }}" />
        <x-jet-input id="name" class="block mt-1 w-md" type="text" name="name" wire:model="name" required autofocus autocomplete="name" />
        @error('name') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div>
        <x-jet-label for="name_2" value="{{ __('Segundo nombre') }}" />
        <x-jet-input id="name_2" class="block mt-1 w-md" type="text" name="name_2" wire:model="name_2" required autofocus autocomplete="name_2" />
        @error('name') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

   


    <div class="form-group">Número de teléfono</label>
        <input type="text" class="form-control" wire:model="phone_number" id="phone_number" placeholder="Ingrese teléfono">
        @error('phone_number') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">Dirección</label>
        <input type="text" class="form-control" wire:model="address_number" id="address_number" placeholder="Ingrese dirección">
        @error('adress_number') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <button wire:click.prevent="update()" class="btn btn-dark">Update</button>
    <button wire:click.prevent="cancel()" class="btn btn-danger">Cancel</button>
</form>