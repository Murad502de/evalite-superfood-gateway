<?php

namespace App\Http\Requests\API\V1;

use App\Models\PasswordReset;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class UserPasswordUpdateRequest__1 extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return PasswordReset::whereEmail($this->email)
            ->whereConfirmCode($this->confirm_code)
            ->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email'        => 'required|email',
            'confirm_code' => 'required',
            'password'     => 'required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json('invalid input data', Response::HTTP_BAD_REQUEST)
        );
    }
}
