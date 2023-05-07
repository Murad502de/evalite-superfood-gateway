<?php

namespace App\Http\Requests\API\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Config;

class ConfigurationCreateRequset__1 extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Config::get('user')->role->code === config('constants.user.roles.admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
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
