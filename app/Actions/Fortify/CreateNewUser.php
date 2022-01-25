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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'middle_name' => ['required'],
            'last_name' => ['required'],
            'gender_id' => ['required'],
            'date_of_birth' => ['required'],
            'country_id' => ['required'],
            'address' => ['required'],
            'telephone' => ['required'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'middle_name' => $input['middle_name'],
            'last_name' => $input['last_name'],
            'gender_id' => $input['gender_id'],
            'date_of_birth' => $input['date_of_birth'],
            'country_id' => $input['country_id'],
            'address' => $input['address'],
            'telephone' => $input['telephone'],
        ]);
    }
}
