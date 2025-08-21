<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'budget' => ['numeric', 'required', 'min:0'],
            'start_date' => ['date', 'required', ],
            'end_date' => ['date', 'after:start_date'],
            'status' => ['string', 'in:in_progress,in_study,completed'], // Assuming status can be one of these values
           'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
           // 'category_id' => ['integer', 'exists:categories,id'],
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
            'title.required' => 'The project title is required.',
            'description.required' => 'The project description is required.',   
            'budget.required' => 'The project budget is required.',
            'budget.min' => 'The project budget must be a positive number.',
            'start_date.required' => 'The project start date is required.',
            'start_date.after_or_equal' => 'The project start date must be today or a future date.',
            'end_date.required' => 'The project end date is required.',
            'end_date.after' => 'The project end date must be after the start date.',
            //'image.image' => 'The project image must be a valid image file.',
            //'image.max' => 'The project image must not exceed 2MB.',
            //'category_id.exists' => 'The selected category is invalid.',
        ];  }
}
