<?php

namespace App\Http\Requests\API\V1;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Config;

class ConfigurationCreateRequset__1 extends FormRequest
{
    public function authorize(): bool
    {
        return Config::get('user')->role->code === Role::$ROLE_CODE_ADMIN;
    }

    public function rules(): array
    {
        return [
            'amocrm_subdomain'     => 'required',
            'amocrm_redirect_uri'  => 'required',
            'amocrm_client_secret' => 'required',
            'amocrm_utm_source_id' => 'required',
            'min_payout'           => 'required',
            'personal_link_host'   => 'required',
        ];
    }
}
