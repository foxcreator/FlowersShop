<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Hash;

class CurrentPasswordCheck implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = auth()->user();
        // Проверяем совпадение введенного пароля с текущим паролем пользователя
        if (!Hash::check($value, $user->password)) {
            // Если пароли не совпадают, вызываем метод $fail для указания ошибки валидации
            $fail("The is incorrect.");
        }
    }

    public function message()
    {
        return 'The is incorrect.';
    }
}
