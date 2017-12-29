<?php

namespace App\Rules;


use Illuminate\Support\Facades\Validator;


class Video extends Rule
{
    private $message = 'There is something wrong with the image you provided.';


    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (\is_string($value)) {
            return true;
        }

        $validator = Validator::make(['video' => $value],
            ['video' => 'mimes:mp4,3gp | max:10000']
        );

        if ($validator->fails()) {
            $this->setMessage($validator->errors()->first());
            return false;
        }
        return true;
    }
}
