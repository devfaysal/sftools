<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::authorize('manage_users');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title' => 'nullable',
            'first_name' => 'required',
            'last_name' => 'required',
            'company' => 'nullable',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable',
            'password' => 'required'
        ];

        if($this->method() == 'PATCH'){
            $rules['password'] = 'nullable';
            $rules['email'] = 'required|email|unique:users,email,' . $this->user->id;
        }
        // dd($rules);
        return $rules;
    }
}
