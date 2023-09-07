<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CategoryRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

     public $forbidden;

    public function __construct($forbidden)
    {
        // I will send all forbidden words

        $this->forbidden = $forbidden;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //

        return ! in_array(strtolower($value),$this->forbidden);

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The vALUES nOT Allowed';
    }
}
