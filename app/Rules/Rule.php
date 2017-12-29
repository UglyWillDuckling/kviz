<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule as ValidationRule;


abstract class Rule implements ValidationRule
{
    private $message = '';


    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return true;
    }


    /**
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
    protected function setMessage($msg) {
        $this->message = $msg;
    }

}
