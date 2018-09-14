<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class WalletAdd
 * @package App\Http\Requests
 *
 * @property string $password
 * @property integer $user_id
 * @property float $amount
 */
class WalletAdd extends FormRequest
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
            'password' => 'required|string',
            'amount' => 'numeric|required'
        ];
    }
}
