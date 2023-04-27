<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuyProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'card_number'  => 'required|numeric|digits:16',
            'card_cvc'     => 'required|numeric|digits:3',
            'expiry_month' => 'required|numeric|digits:2',
            'expiry_year'  => 'required|numeric|digits:2',
            'email'        => 'required|email'
        ];
    }
}
