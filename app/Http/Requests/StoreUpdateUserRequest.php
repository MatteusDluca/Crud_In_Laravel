<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateUserRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8', ],
        ];

        if($this->method() == 'PATCH' )
        {
            $rules['password'] = ['nullable', 'min:8', 'max:100'];
            // $rules['email'] = ['required', 'email', 'max:255', "unique:users,email,{$this->id},id"];
            Rule::unique('users')->ignore($this->id);

        }

        return $rules;
    }
}
