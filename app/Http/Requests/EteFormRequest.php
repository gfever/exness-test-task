<?php
/**
 * Created by PhpStorm.
 * User: fevr
 * Date: 15.09.2018
 * Time: 21:47
 */

namespace App\Http\Requests;


use App\Exceptions\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class EteFormRequest extends FormRequest
{
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw (new ValidationException($validator, 400))
            ->errorBag($this->errorBag);
    }
}
