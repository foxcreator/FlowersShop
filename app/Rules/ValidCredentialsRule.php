<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Hash;

class ValidCredentialsRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (request('credential')) {
            $user = User::where('phone', request('credential'))->orWhere('email', request('credential'))->first();
        }

        if (!$user || !Hash::check(request('password'), $user->password)) {
            $fail('Невірні облікові дані');
        }
    }
}
