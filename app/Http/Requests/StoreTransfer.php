<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreTransfer
 * @package App\Http\Requests
 *
 * @property-read int $sender_id
 * @property-read int $recipient_id
 * @property-read string $currency_code
 * @property-read float $amount
 */
class StoreTransfer extends FormRequest
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
            'sender_id' => 'required|integer|exists:users,id',
            'recipient_id' => 'required|integer|different:sender_id|exists:users,id',
            'currency_code' => 'required|exists:currencies,code',
            'amount' => 'required|numeric'
        ];
    }
}
