<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\ServicesAmoCrmAuthRequest__1;
use App\Models\Amocrm;
use App\Models\Configuration;
use App\Services\amoAPI\amoAPIHub;
use Illuminate\Http\Response;

class ServicesAmoCrmController__1 extends Controller
{
    public function signin(ServicesAmoCrmAuthRequest__1 $request)
    {
        $configuration = Configuration::first();

        if ($configuration) {
            $amo = new amoAPIHub([
                'client_id'     => $request->all()['client_id'],
                'client_secret' => $configuration->amocrm_client_secret,
                'code'          => $request->all()['code'],
                'redirect_uri'  => $configuration->amocrm_redirect_uri,
                'subdomain'     => $configuration->amocrm_subdomain,
            ]);
            $response    = $amo->auth();
            $accountData = [
                'client_id'     => $request->all()['client_id'],
                'client_secret' => $configuration->amocrm_client_secret,
                'subdomain'     => $configuration->amocrm_subdomain,
                'access_token'  => $response['access_token'],
                'redirect_uri'  => $configuration->amocrm_redirect_uri,
                'token_type'    => $response['token_type'],
                'refresh_token' => $response['refresh_token'],
                'when_expires'  => time() + (int) $response['expires_in'] - 400,
            ];
            Amocrm::signin($accountData);
        }

        return response()->json(['message' => 'success'], Response::HTTP_OK);
    }
    public function signout()
    {
        Amocrm::signout();
        return response()->json(['message' => 'success'], Response::HTTP_OK);
    }
    public function webhookLead()
    {
        return response()->json(['message' => 'success'], Response::HTTP_OK);
    }
}
