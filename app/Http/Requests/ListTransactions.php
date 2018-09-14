<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ListTransactions
 * @package App\Http\Requests
 *
 * @property string $from_date
 * @property string $to_date
 * @property string $user_name
 */
class ListTransactions extends FormRequest
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
            'download' => 'int',
            'from_date' => 'nullable|date_format:Y-m-d',
            'to_date' => 'nullable|date_format:Y-m-d',
            'user_name' => 'string|required|exists:users,name',
        ];
    }
}
