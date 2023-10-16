<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Validator;

class RoleEnumValue implements ValidationRule
{
    protected $validator;
    protected $enumValues;

    public function __construct(Validator $validator, array $enumValues)
    {
        $this->validator = $validator;
        $this->enumValues = $enumValues;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->validator->in($value, $this->enumValues)->validate()) {
            $fail('The :attribute must be one of the following: ' . implode(', ', $this->enumValues));
        }
    }
}
