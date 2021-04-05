<x-guest-layout>
    {{--  <x-jet-authentication-card>  --}}
        <x-slot name="logo">
            <img src="{{asset('img/logo_naranja.png')}}" width="150" height="150"> 
            <img src="{{asset('img/Logo2.png')}}" width="160" height="150">
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" class="mt-5 mb-5">
            @csrf

            <div>
                <x-jet-label for="numero_documento" value="{{ __('Numero de documento') }}" />
                <x-jet-input id="numero_documento" class="block mt-1 w-auto" type="number" name="numero_documento" :value="old('numero_documento')" required autofocus autocomplete="numero_documento" />
            </div>
            <br/>

            <div>
                <x-jet-label for="name" value="{{ __('Primer nombre') }}" />
                <x-jet-input id="name" class="block mt-1 w-auto" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>
            <br/>
            <div>
                <x-jet-label for="name_2" value="{{ __('Segundo nombre') }}" />
                <x-jet-input id="name_2" class="block mt-1 w-auto" type="text" placeholder="Opcional"  name="name_2" :value="old('name_2')"  autofocus autocomplete="name_2" />
            </div>
            <br/>
            <div>
                <x-jet-label for="last_name" value="{{ __('Primer apellido') }}" />
                <x-jet-input id="last_name" class="block mt-1 w-auto" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name" />
            </div>
            <br/>
            <div>
                <x-jet-label for="last_name_2" value="{{ __('Segundo apellido') }}" />
                <x-jet-input id="last_name_2" class="block mt-1 w-auto" type="text" placeholder="Opcional" name="last_name_2" :value="old('last_name_2')"  autofocus autocomplete="last_name_2" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Correo electrónico') }}" />
                <x-jet-input id="email" class="block mt-1 w-auto" type="email" name="email" :value="old('email')" required />
            </div>
            <br/>
            <div>
                <x-jet-label for="phone_number" value="{{ __('Número de teléfono') }}" />
                <x-jet-input id="phone_number" class="block mt-1 w-auto" type="tel" placeholder="Fijo (03?1234567) o celular (3??1234567)" pattern="[0-9]{10}"  name="phone_number" :value="old('phone_number')" required autofocus autocomplete="phone_number" />
            </div>
            <br/>
            <div>
                <x-jet-label for="address_number" value="{{ __('Dirección') }}" />
                <x-jet-input id="address_number" class="block mt-1 w-auto" type="text" name="address_number" :value="old('address_number')" required autofocus autocomplete="address_number" />
            </div>

            <div>
                <!-- <x-jet-label for="estado" value="{{ __('Estado') }}" /> -->
                <x-jet-input id="estado" class="block mt-1 w-auto" type="hidden" name="estado" value="Activo"  />
            </div>
            <!-- <br/> -->

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                <x-jet-input id="password" class="block mt-1 w-auto" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirmar contraseña') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-auto" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-center mt-4">
                <x-jet-button class="ml-4">
                    {{ __('Registrar') }}
                </x-jet-button>
            </div>

            <div class="flex items-center justify-center mt-4">
                <a class="underline text-sm text-orange-400 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('¿Ya estás registrado?') }}
                </a>
            </div>
        </form>
    {{--  </x-jet-authentication-card>  --}}
</x-guest-layout>
