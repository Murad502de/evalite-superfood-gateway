<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\ConfigurationCreateRequset__1;
use App\Http\Requests\API\V1\ConfigurationUpdateRequset__1;
use App\Http\Resources\API\V1\ConfigurationReadResource__1;
use App\Models\Configuration;
use Illuminate\Http\Response;

class ConfigurationController__1 extends Controller
{
    public function create(ConfigurationCreateRequset__1 $request)
    {
        Configuration::truncate();
        $configuration = Configuration::create($request->all());
        $configuration->configurationPercentageLevels()->createMany($request->percentage_levels);
        return response()->json(['message' => 'success'], Response::HTTP_OK);
    }
    public function read()
    {
        return new ConfigurationReadResource__1(Configuration::first() ?? Configuration::create([
            'amocrm_subdomain'     => '',
            'amocrm_redirect_uri'  => '',
            'amocrm_client_secret' => '',
            'amocrm_utm_source_id' => 0,
            'min_payout'           => 0,
            'personal_link_host'   => '',
            'percentage'           => 0,
        ]));
    }
    public function update(ConfigurationUpdateRequset__1 $request)
    {
        $configuration = Configuration::first();

        if ($configuration) {
            $configuration->update($request->all());
            return response()->json(['message' => 'success'], Response::HTTP_OK);
        }

        return response()->json(['message' => 'configuration not found'], Response::HTTP_NOT_FOUND);
    }
    public function delete()
    {
        Configuration::truncate();
        return response()->json(['message' => 'success'], Response::HTTP_OK);
    }
}
