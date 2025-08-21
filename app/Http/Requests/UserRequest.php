<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {  return [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $this->user?->id,
         'password' => $this->isMethod('post') ? 'required|min:6' : 'sometimes|min:6',
         'phone'=>['string','nullable',],
        'role_ids' => 'sometimes|array',
        'role_ids.*' => 'exists:roles,id',
    ];
       
    }
    /**
     * Get custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {   
        return [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 6 characters.',
            // 'password.confirmed' => 'The password confirmation does not match.',
            // 'phone.regex' => 'The phone number format is invalid. It should be a valid international format.',
        ];
    }
}
