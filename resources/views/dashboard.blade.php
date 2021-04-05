<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" align="center">
            {{ __('Firma') }}  SENA SIOSOP
        
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7x1 mx-auto ms:px-6 lg:px-8 ">
            <div class="bg-white overflow-hidden shadow-xl ms:rounded-lg rounded">
                @livewire('firmas')
            </div>
        
        </div>
    </div>

</x-app-layout>
  
