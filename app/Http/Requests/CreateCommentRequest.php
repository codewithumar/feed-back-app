<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'feedback_id' => 'required|integer|exists:feedbacks,id',
            'user_id' => 'required|integer|exists:users,id',
            'content' => 'required|string',
        ];
    }
}
