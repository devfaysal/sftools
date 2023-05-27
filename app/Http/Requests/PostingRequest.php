<?php

namespace App\Http\Requests;

use App\Models\Posting;
use Illuminate\Foundation\Http\FormRequest;

class PostingRequest extends FormRequest
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
            'schedule' => 'required',
            'amount' => 'required',
            'postingtext' => 'required',
            'postingaccount_debit' => 'required',
            'postingaccount_debit_other' => 'required_if:postingaccount_debit,Other',
            'postingaccount_credit' => 'required',
            'postingaccount_credit_other' => 'required_if:postingaccount_credit,Other',
            'vat' => 'required',
            'status' => 'required'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'status' => $this->status ? Posting::STATUS_ACTIVE : Posting::STATUS_INACTIVE,
        ]);
    }
}
