<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubcriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // You can add your authorization logic here
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

      'subscriber_id'=> 'required|exists:users,id',
        'amount' => 'required|numeric|min:0',
        'month' => 'required|integer|min:1|max:12',
        'payment_method' => 'required|string|max:50',
        'status' => 'required|in:paid,not_paid,pending', // Adjusted status values
        'paid_at' => 'nullable|date',
        ];
      
    }
}
