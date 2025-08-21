<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
    {
        return [ 
            'name' =>$this->isMethod('post')? ['required', 'string', 'max:255']: ['sometimes', 'string', 'max:255'],
            'description' => ['string', 'required', 'max:255'], // Optional description field


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
            'name.required' => 'The role name is required.',
            'name.string' => 'The role name must be a string.',
            'name.max' => 'The role name may not be greater than 255 characters.',
        ];
    }
    /**
     * Prepare the data for validation.
     */
}
    
  