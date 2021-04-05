<form>
    <div>
        <x-jet-label for="name" value="{{ __('Primer nombre') }}" />
        <x-jet-input id="name" class="block mt-1 w-med" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Nombre</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Name" wire:model="name">
        @error('name') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput2">Correo electrónico</label>
        <input type="email" class="form-control" id="exampleFormControlInput2" wire:model="email" placeholder="Enter Email">
        @error('email') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <button wire:click.prevent="store()" class="btn btn-success">Guardar</button>
</form>