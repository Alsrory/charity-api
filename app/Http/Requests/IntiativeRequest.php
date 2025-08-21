<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IntiativeRequest extends FormRequest
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
            'title' => ['string', 'required', 'max:255'],
            'description' => ['string', 'required'],
            'current_amount' => ['numeric' , 'min:0'],
            'target_amount' => ['numeric', 'min:0'], // Uncomment if needed
            'start_date' => ['date', 'required', 'after_or_equal:today'],
            'end_date' => ['date', 'after:start_date'],
           'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
            //'category_id' => ['integer', 'exists:categories,id'],
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
            'title.required' => 'The initiative title is required.',
            'description.required' => 'The initiative description is required.',
            'current_amount.required' => 'The current amount is required.',
            'current_amount.min' => 'The current amount must be a positive number.',
            'target_amount.required' => 'The target amount is required.',
            'target_amount.min' => 'The target amount must be a positive number.',
            'start_date.required' => 'The initiative start date is required.',
            'start_date.after_or_equal' => 'The initiative start date must be today or a future date.',
            'end_date.required' => 'The initiative end date is required.',
            'end_date.after' => 'The initiative end date must be after the start date.',
            //'image.image' => 'The initiative image must be a valid image file.',
            //'image.max' => 'The initiative image must not exceed 2MB.',
            //'category_id.exists' => 'The selected category is invalid.',
        ];
    }
}
