<?php

namespace App\Rules;


use Illuminate\Support\Facades\Validator;


class Image extends Rule
{
    private $message = 'There is something wrong with the image you provided.';


    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value) //todo add class for file validation
    {
        if (\is_string($value)) {
            return true;
        }

        $validator = Validator::make(['image' => $value],
            ['image' => 'mimes:jpeg,jpg,png,gif | max:5000']
        );

        if ($validator->fails()) {
            $this->setMessage($validator->errors()->first());
            return false;
        }
        return true;
    }
}
