<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListTransactions extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'from_date' => 'date_format:Y-m-d',
            'to_date' => 'date_format:Y-m-d',
            'user_name' => 'string|required|exists:users,name',
        ];
    }
}
