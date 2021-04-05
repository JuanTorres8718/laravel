<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'numero_documento'=> ['required', 'integer', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'name_2' => ['string', 'max:255', 'nullable'],
            'last_name' => ['required', 'string', 'max:255'],
            'last_name_2' => ['string', 'max:255', 'nullable'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'string', 'max:255'],
            'address_number' => ['required', 'string', 'max:255'],
            'estado' => ['required', 'string', 'max:255'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return User::create([
            'numero_documento' => $input['numero_documento'],
            'name' => $input['name'],
            'name_2' => $input['name_2'],
            'last_name' => $input['last_name'],
            'last_name_2' => $input['last_name_2'],
            'email' => $input['email'],
            'phone_number' => $input['phone_number'],
            'address_number' => $input['address_number'],
            'estado' => $input['estado'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
