<?php

namespace App\Rules;

use Illuminate\Support\Facades\Validator;


class Answers extends Rule
{
    private $numberOfAnswers;
    private $message = 'There is something wrong with the answers you gave.';

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($numberOfAnswers)
    {

        $this->numberOfAnswers = $numberOfAnswers;
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
        $answers = \GuzzleHttp\json_decode($value);


        if (!is_array($answers) || sizeof($answers) != $this->numberOfAnswers) {
            $this->setMessage('The given number of answers does not match.');
            return false;
        }


        $validator = Validator::make($answers, [
            '*.content' => 'required|min:10',
            '*.type' => 'required',
        ]);

        if ($validator->fails()) {
            return false;
        }

        return true;
    }
}
