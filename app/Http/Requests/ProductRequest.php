<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
             'product_name' => ['required','min:10','max:150'],
             'shipping_address' => ['required','min:10','max:150'],
             'price' => ['numeric']
         ];
     }

     public function messages(){
       return [
         "required.product_name" => "Product can't be null",
         "product_name.min" => "Product min 10 character",
         "product_name.max" => "Product max 150 character",
         "required.shipping_address" => "Shipping Address can't be null",
         "shipping_address.min" => "Shipping Address min 10 character",
         "shipping_address.max" => "Shipping Address max 150 character",
         "numeric" => "Invalid price value",
       ];
     }
}
