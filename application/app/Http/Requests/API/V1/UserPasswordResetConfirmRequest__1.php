<?php

namespace App\Http\Requests\API\V1;

use App\Models\PasswordReset;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class UserPasswordResetConfirmRequest__1 extends FormRequest
{
    public function authorize(): bool
    {
        return PasswordReset::whereEmail($this->email)
            ->whereConfirmCode($this->confirm_code)
            ->exists();
    }
    public function rules(): array
    {
        return [
            'email'        => 'required|email',
            'confirm_code' => 'required',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json('invalid input data', Response::HTTP_BAD_REQUEST)
        );
    }
}
