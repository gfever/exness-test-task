<?php

namespace App\Http\Requests;

/**
 * Class StoreUser
 *
 * @package App\Http\Requests\
 *
 * @property-read string $name
 * @property-read string $email
 * @property-read string $password
 * @property-read string $country
 * @property-read string $city
 * @property-read string $currency_code
 */
class StoreUser extends EteFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|string|unique:users,name',
            'email'         => 'required|email|unique:users,email',
            'country'       => 'required|string',
            'password'      => 'required|string',
            'city'          => 'required|string',
            'currency_code' => 'required'
        ];
    }
}
