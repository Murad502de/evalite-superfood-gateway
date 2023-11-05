<?php

namespace App\Http\Requests\API\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Config;
use App\Models\Role;

class ConfigurationUpdateRequset__1 extends FormRequest
{
    public function authorize(): bool
    {
        return Config::get('user')->role->code === Role::$ROLE_CODE_ADMIN;
    }

    public function rules(): array
    {
        return [];
    }
}
