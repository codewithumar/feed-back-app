<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFeedbackRequest extends FormRequest
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

            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:10|max:1000',
            'category' => 'required|string|in:bug,feature,improvement,comment',
            'user_id' => 'required|integer|exists:users,id'

        ];
    }
}
