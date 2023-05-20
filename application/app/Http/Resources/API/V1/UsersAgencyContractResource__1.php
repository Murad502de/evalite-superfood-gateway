<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\AgencyContract;

class UsersAgencyContractResource__1 extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(parent::toArray($request), [
            'agency_contract_url' => $this->getMedia(AgencyContract::MEDIA_PREFIX_AGENCY_CONTRACT . $this->uuid)->first()->getUrl(),
        ]);
    }
}
