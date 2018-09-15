<?php

namespace App\Http\Requests;

/**
 * Class StoreTransfer
 * @package App\Http\Requests
 *
 * @property int $sender_id
 * @property int $recipient_id
 * @property string $currency_code
 * @property string $sender_password
 * @property float $amount
 */
class StoreTransfer extends EteFormRequest
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
            'sender_password' => 'required|string',
            'sender_id' => 'required|integer|exists:users,id',
            'recipient_id' => 'required|integer|different:sender_id|exists:users,id',
            'currency_code' => 'required|exists:currencies,code',
            'amount' => 'required|numeric'
        ];
    }
}
