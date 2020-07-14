<?php

namespace App\Rules;

use Session;

use Illuminate\Contracts\Validation\Rule;

class validateReinclusion implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     * Валидатор предназначен для предотвращения повторной отправки формы
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!session($attribute)) {
            session([$attribute => $value]);
            return true;
        } else {
            if ($value != session($attribute)) {
                session([$attribute => $value]);
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
