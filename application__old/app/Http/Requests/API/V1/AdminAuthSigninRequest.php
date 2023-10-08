<?php

namespace App\Http\Requests\API\V1;

use App\Models\User;
use App\Traits\PasswordEncryptTrait;
use Illuminate\Foundation\Http\FormRequest;

class AdminAuthSigninRequest extends FormRequest
{
    use PasswordEncryptTrait;

    public function authorize(): bool
    {
        return User::where('email', $this->email)
            ->where('password', $this->passwordEncrypt($this->password))
            ->exists();
    }

    public function rules(): array
    {
        return [];
    }
}
