<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\ServicesAmoCrmAuthRequest__1;
use App\Models\Amocrm;
use App\Services\amoAPI\amoAPIHub;

class ServicesAmoCrmController__1 extends Controller
{
    public function signin(ServicesAmoCrmAuthRequest__1 $request)
    {
        $authData = [
            'client_id'     => $request->all()['client_id'],
            'client_secret' => config('services.amoCRM.client_secret'), // TODO get from Configuration model
            'code'          => $request->all()['code'],
            'redirect_uri'  => config('services.amoCRM.redirect_uri'), // TODO get from Configuration model
            'subdomain'     => config('services.amoCRM.subdomain'), // TODO get from Configuration model
        ];
        $amo         = new amoAPIHub($authData);
        $response    = $amo->auth();
        $accountData = [
            'client_id'     => $request->all()['client_id'],
            'client_secret' => config('services.amoCRM.client_secret'), // TODO get from Configuration model
            'subdomain'     => $authData['subdomain'],
            'access_token'  => $response['access_token'],
            'redirect_uri'  => $authData['redirect_uri'],
            'token_type'    => $response['token_type'],
            'refresh_token' => $response['refresh_token'],
            'when_expires'  => time() + (int) $response['expires_in'] - 400,
        ];

        Amocrm::signin($accountData);
        return response(['OK'], 200);
    }
    public function signout()
    {
        Amocrm::signout();
        return response(['OK'], 200);
    }
}
