<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreUser
 * @package App\Http\Requests\
 *
 * @property-read string $name
 * @property-read string $email
 * @property-read string $password
 * @property-read string $country
 * @property-read string $city
 * @property-read string $currency_code
 */
class StoreUser extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email',
            'country' => 'required|string',
            'password' => 'required|string',
            'city' => 'required|string',
            'currency_code' => 'required'
        ];
    }
}
