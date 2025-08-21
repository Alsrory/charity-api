<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriberRequest extends FormRequest
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
            
            'status' => ['required', 'in:active,cancelled,suspended,subscriber'],
            'user_id'=>['required','exists:users,id'],
            'subscribed_at' =>['required','date']
     
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
         
           
            'status.required' => 'The subscription status is required.',
            'status.in' => 'The subscription status must be one of the following: active, inactive, cancelled, suspended.',
        ];  }
}
