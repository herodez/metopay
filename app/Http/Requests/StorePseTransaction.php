<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Cache;

class StorePseTransaction extends FormRequest
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
            'client' => 'required|in:0,1',
            'bank' => [
                'required',
                Rule::in(
                    Cache::get('placetopay_banklist', collect())
                          ->where('bankCode', '!=', '0')
                          ->pluck('bankCode')
                          ->all()
                ),
            ],
            'amount' => 'required|numeric' 
        ];
    }
}
