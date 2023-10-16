<?php

namespace App\Http\Requests;

use App\Rules\RoleEnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;


class UserRegisterRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            // 'role' => [new RoleEnumValue($this->validator, RoleEnum::cases())],
        ];
    }
}

enum RoleEnum: string
{
    case Admin = 'Admin';
    case Guest = 'User';
}
