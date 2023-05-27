<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlentyMarketProductRequest extends FormRequest
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
            'product_name' => 'required',
            'mu_varient' => 'required',
            'ms_varient' => 'required',
            'on_varient' => 'required',
            'stock' => 'required',
            'minimum_stock' => 'required',
            'status' => 'required',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'status' => 'Active'
        ]);
    }
}
