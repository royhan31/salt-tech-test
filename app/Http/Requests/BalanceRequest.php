<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BalanceRequest extends FormRequest
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
            'mobile_number' => ['required','regex:/(081)/'],
            'value' => ['required']
        ];
    }

    public function messages(){
      return [
        "required.mobile_number" => "Mobile Number can't be null",
        "regex" => "Mobile Number must 081",
        "required.value" => "Value can't be null",
      ];
    }
}
