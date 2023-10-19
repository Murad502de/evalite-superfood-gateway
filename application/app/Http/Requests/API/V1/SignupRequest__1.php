<?php

namespace App\Http\Requests\API\V1;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class SignupRequest__1 extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !User::whereEmail($this->user_email)
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
            //
        ];
    }
}
