<?php

namespace App\Http\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\User;

class VerifiedEmail implements Rule
{
    /**
     * @param $attribute
     * @param $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $user = User::where('email', $value)->whereNotNull('email_verified_at')->first();
        return $user !== null;
    }

    public function message()
    {
        return 'The email address is not verified.';
    }
}
